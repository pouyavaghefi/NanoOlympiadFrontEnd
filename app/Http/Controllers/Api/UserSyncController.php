<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Member;

class UserSyncController extends Controller
{
    public function syncProfile(Request $request)
    {
        if (!$this->authorizeSync($request)) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $data = $request->only(['user_id', 'email', 'fname', 'lname', 'uname', 'avatar', 'member_data']);

        $user = User::updateOrCreate(
            ['id' => $data['user_id']],
            [
                'email' => $data['email'],
                'fname' => $data['fname'],
                'lname' => $data['lname'],
                'uname' => $data['uname'],
                'avatar' => $data['avatar'],
            ]
        );

        if (isset($data['member_data'])) {
            $user->member()->updateOrCreate(['user_id' => $user->id], $data['member_data']);
        }

        return response()->json(['success' => true, 'message' => 'Profile synced successfully.']);
    }

    public function syncAvatar(Request $request)
    {
        if (!$this->authorizeSync($request)) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'avatar' => 'required|image',
        ]);

        $user = User::find($request->user_id);
        $path = $request->file('avatar')->store("public/users/{$user->id}");
        $user->avatar = str_replace('public/', '', $path);
        $user->save();

        return response()->json(['success' => true, 'message' => 'Avatar synced successfully.']);
    }

    public function syncPassport(Request $request)
    {
        if (!$this->authorizeSync($request)) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'member_id' => 'required|integer|exists:members,id',
            'passport_photo' => 'required|image',
        ]);

        $path = $request->file('passport_photo')->store("public/members/{$request->user_id}");

        $member = Member::where('id', $request->member_id)->where('user_id', $request->user_id)->first();

        if ($member) {
            $member->passport_photo = str_replace('public/', '', $path);
            $member->save();
        }

        return response()->json(['success' => true, 'message' => 'Passport photo synced successfully.']);
    }

    protected function authorizeSync(Request $request): bool
    {
        $apiKey = $request->bearerToken();
        return $apiKey === config('app.api_sync_key');
    }
}
