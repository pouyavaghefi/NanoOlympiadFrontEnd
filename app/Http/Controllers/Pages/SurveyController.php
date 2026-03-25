<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\SurveySubmission;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
class SurveyController extends Controller
{
    public function show()
    {
        return view('web-pages.survey.reg.main');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'personal_photo' => 'required|image|mimes:jpeg,png,jpg',
            'identification_document' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'telegram_phone' => 'required|string',
//            'telegram_username' => 'required|string',
            'email' => 'required|email',
        ]);

        // Create submission folder
        $folderName = 'submission_' . now()->timestamp;
        $basePath = "survey/completedReg/{$folderName}";

        // Store files
        $photoPath = $request->file('personal_photo')
            ->store("{$basePath}/avatar", 'local');

        $idDocumentPath = null;
        if ($request->hasFile('identification_document')) {
            $idDocumentPath = $request->file('identification_document')
                ->store("{$basePath}/id", 'local');
        }

        // Create submission record
        $submission = SurveySubmission::create([
            'user_id' => auth()->id(),
            'telegram_phone' => $request->telegram_phone,
//            'telegram_username' => $request->telegram_username,
            'email' => $request->email,
            'personal_photo_path' => $photoPath,
            'identification_document_path' => $idDocumentPath,
            'folder_name' => $folderName,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'referer' => $request->headers->get('referer'),
            'locale' => app()->getLocale(),
        ]);

        // Send Telegram message
        $messageSent = $this->sendTelegramMessage(
            $request->telegram_username,
            "✅ Your registration has been submitted successfully!\n\n" .
            "We'll review your information and get back to you soon."
        );

        return response()->json([
            'success' => true,
            'telegram_message_sent' => $messageSent
        ]);
    }

    private function sendTelegramMessage($username, $message)
    {
        $botToken = config('services.telegram.bot_token');

        // Remove @ symbol if present
        $username = ltrim($username, '@');

        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";

        try {
            $response = \Illuminate\Support\Facades\Http::post($url, [
                'chat_id' => '@' . $username,
                'text' => $message,
                'parse_mode' => 'HTML'
            ]);

            // Log the response for debugging
            \Log::info('Telegram API Response:', $response->json());

            return $response->successful();
        } catch (\Exception $e) {
            \Log::error("Telegram message failed to @{$username}: " . $e->getMessage());
            return false;
        }
    }

    private function normalizeTelegramPhone($phone)
    {
        return preg_replace('/[^0-9]/', '', $phone); // E.g., +989123456789 → 989123456789
    }

    public function testTelegramMessage(Request $request, $username)
    {
        $message = $request->input('message', 'Test message from debug endpoint');
        $result = $this->sendTelegramMessage($username, $message);

        return response()->json([
            'success' => $result,
            'username' => $username,
            'message' => $message,
        ]);
    }

    public function getPrivateImage($submission, $filename)
    {
        $path = "private/survey/completedReg/submission_{$submission}/id/{$filename}";

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        $file = Storage::get($path);
        $mime = Storage::mimeType($path);

        return Response::make($file, 200)->header("Content-Type", $mime);
    }
}
