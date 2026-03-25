<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelegramController extends Controller
{
    public function webhook(Request $request)
    {
        Log::info('Telegram webhook data:', $request->all());

        $data = $request->all();

        if (isset($data['message'])) {
            $chatId = $data['message']['chat']['id'];
            $text = $data['message']['text'];

            // Save $chatId to DB linked to this user's Telegram number if you want
            // Or reply back
            \Http::post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendMessage", [
                'chat_id' => $chatId,
                'text' => "👋 Thank you for contacting us!",
            ]);
        }

        return response('OK', 200);
    }


    private function sendTelegramMessage($username, $message)
    {
        $botToken = config('services.telegram.bot_token');
        $username = ltrim($username, '@');

        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";

        try {
            $response = \Illuminate\Support\Facades\Http::timeout(10)->post($url, [
                'chat_id' => '@' . $username,
                'text' => $message,
                'parse_mode' => 'HTML'
            ]);

            $responseData = $response->json();
            \Log::info('Telegram API Response:', $responseData);

            if (!$response->successful()) {
                // Handle specific Telegram API errors
                if (isset($responseData['description'])) {
                    if (str_contains($responseData['description'], 'chat not found')) {
                        \Log::error("User @{$username} needs to start chat with bot first");
                        // You could store this to notify admin later
                    }
                }
                return false;
            }

            return true;
        } catch (\Exception $e) {
            \Log::error("Telegram send failed to @{$username}: " . $e->getMessage());
            return false;
        }
    }
}