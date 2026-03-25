<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailCheckerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Api\UserSyncController;

Route::get('/user-files/upload/{user_id}', function($user_id, Request $request) {
    $base64 = $request->query('content');
    $filename = $request->query('filename');

    if (!$base64 || !$filename) {
        return response()->json(['error' => 'Missing file data'], 400);
    }

    $user = \App\Models\User::find($user_id);
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    try {
        $directory = "members/{$user->id}";
        $disk = Storage::disk('private');

        if (!$disk->exists($directory)) {
            $disk->makeDirectory($directory);
        }

        $decoded = base64_decode($base64);
        $filename = uniqid() . '_' . $filename;
        $disk->put("{$directory}/{$filename}", $decoded);

        return response()->json([
            'success' => true,
            'filename' => $filename
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});


Route::post('/sync-profile', [UserSyncController::class, 'syncProfile']);
Route::post('/sync-avatar', [UserSyncController::class, 'syncAvatar']);
Route::post('/sync-passport', [UserSyncController::class, 'syncPassport']);

Route::get('/email-check', [EmailCheckerController::class, 'check'])->name('api.email.check');

Route::get('/check-active-token', function () {
    $user = Auth::user();

    if ($user) {
        $activeToken = DB::table('user_access_tokens')
            ->where('user_id', $user->id)
            ->where('expires_at', '>', now())
            ->exists();

        return response()->json(['has_active_token' => $activeToken]);
    }

    return response()->json(['has_active_token' => false]);
});

Route::post('/logout', function (Request $request) {
    $userId = Auth::id();

    if ($userId) {
        DB::table('user_access_tokens')->where('user_id', $userId)->delete();

        Auth::logout();

        return Response::json([
            'message' => 'User logged out successfully.'
        ], 200);
    }

    return Response::json([
        'message' => 'No authenticated user found.'
    ], 401);
});


Route::get('/log-user-in/{userId}', function ($userId) {
    auth()->loginUsingId($userId);

    return response()->json(['message' => "User $userId login recorded"]);
});


Route::post('/user-logged-in', function (Request $request) {
    $userId = $request->input('user_id');
    $token = $request->input('token');

    if (!$userId || !$token) {
        return response()->json(['message' => 'Missing user_id or token'], 400);
    }

    $user = User::find($userId);
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }
    Auth::login($user);

    return response()->json(['message' => 'User login recorded successfully']);
});

Route::get('/user-files/{id}', function($id) {
    $user = \App\Models\User::find($id);
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $directory = "public/members/{$user->id}";
    $disk = Storage::disk('private');

    try {
        if (!$disk->exists($directory)) {
            return response()->json(['files' => []]);
        }

        $files = $disk->files($directory);

        $imageFiles = array_filter($files, function($file) {
            return preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file);
        });

        $formattedFiles = array_map(function($file) use ($user, $disk) {
            return [
                'name' => basename($file),
                'url' => route('private.files', [
                    'user_id' => $user->id,
                    'filename' => basename($file)
                ]),
                'size' => $disk->size($file),
                'mime_type' => $disk->mimeType($file),
                'modified' => date('Y-m-d H:i:s', $disk->lastModified($file)), // Changed from last_modified to modified
                'timestamp' => $disk->lastModified($file) // Keep original timestamp if needed
            ];
        }, $imageFiles);

        return response()->json(['files' => array_values($formattedFiles)]);

    } catch (\Exception $e) {
        \Log::error("File fetch error: ".$e->getMessage());
        return response()->json(['error' => 'File fetch failed'], 500);
    }
});

Route::get('/user-files/{id}/download-zip', function($id) {
    $user = \App\Models\User::find($id);
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $directory = "public/members/{$user->id}";
    $disk = Storage::disk('private');

    // Check if directory exists
    if (!$disk->exists($directory)) {
        return response()->json(['error' => 'No files found'], 404);
    }

    // Get all files
    $files = $disk->files($directory);

    // Filter only image files (same as your view endpoint)
    $imageFiles = array_filter($files, function($file) {
        return preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file);
    });

    if (empty($imageFiles)) {
        return response()->json(['error' => 'No files available for download'], 404);
    }

    // Create a temporary zip file
    $zipFileName = "user_{$user->id}_files_".now()->format('Ymd_His').'.zip';
    $zipPath = storage_path("app/temp/{$zipFileName}");

    // Ensure temp directory exists
    if (!file_exists(storage_path('app/temp'))) {
        mkdir(storage_path('app/temp'), 0755, true);
    }

    // Create the zip file
    $zip = new \ZipArchive();
    if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
        foreach ($imageFiles as $file) {
            $zip->addFile($disk->path($file), basename($file));
        }
        $zip->close();

        // Stream the zip file
        return response()->download($zipPath, $zipFileName, [
            'Content-Type' => 'application/zip',
        ])->deleteFileAfterSend(true);
    }

    return response()->json(['error' => 'Failed to create ZIP archive'], 500);
});

Route::get('/user-files/delete-all-files/{id}', function($id) {
    $user = \App\Models\User::find($id);

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $directory = "public/members/{$user->id}";
    $disk = Storage::disk('private');

    if (!$disk->exists($directory)) {
        return response()->json(['error' => 'No files found'], 404);
    }

    $files = $disk->files($directory);

    if (empty($files)) {
        return response()->json(['message' => 'No files to delete'], 200);
    }

    $deletedCount = 0;
    $failedDeletions = [];

    foreach ($files as $file) {
        try {
            if ($disk->delete($file)) {
                $deletedCount++;
            } else {
                $failedDeletions[] = $file;
            }
        } catch (\Exception $e) {
            $failedDeletions[] = $file;
        }
    }

    return response()->json([
        'message' => 'Files deletion completed',
        'deleted_count' => $deletedCount,
        'failed_count' => count($failedDeletions),
        'failed_files' => $failedDeletions
    ]);
});

Route::get('/private-files/{user_id}/{filename}', function($user_id, $filename) {
    // First try avatar path
    $avatarPath = "users/{$user_id}/{$filename}";
    $disk = Storage::disk('private');

    if ($disk->exists($avatarPath)) {
        return response()->file($disk->path($avatarPath));
    }

    // Then try members path (for other files)
    $memberPath = "public/members/{$user_id}/{$filename}";
    if ($disk->exists($memberPath)) {
        return response()->file($disk->path($memberPath));
    }

    abort(404);
})->name('private.files')->middleware('auth');

//Route::get('/user-image/users/{user_id}/{filename}', function($user_id, $filename) {
//    $disk = Storage::disk('private');
//
//    // Check these possible storage paths
//    $possiblePaths = [
//        "users/{$user_id}/{$filename}",          // Direct in user folder
//        "public/members/{$user_id}/{$filename}" // In members folder
//    ];
//
//    foreach ($possiblePaths as $path) {
//        if ($disk->exists($path)) {
//            return response()->file($disk->path($path))
//                ->header('Cache-Control', 'public, max-age=86400');
//        }
//    }
//
//    // Fallback to default avatar if not found
//    return response()->file(public_path('img/avatar.png'));
//})->name('api.user.image');