<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelegramController extends Controller
{
    public function handle(Request $request)
    {
        $input = $request->all();
        $message = $input['message'];
        $chat_id = $message['chat']['id'];
        $text = $message['text'];

        if($text == '/start')
        {
            $this->call('sendMessage', [
                'chat_id' => $chat_id,
                'text' => "Asssalomu alaykum"
            ]);
        }else{
            $this->call('sendMessage', [
                'chat_id' => $chat_id,
                'text' => "Noma'lum"
            ]);
        }
    }

    private function call(string $method, $params = [])
    {
        $url = "https://api.telegram.org/bot" . config('services.telegram.api_key') . "/" . $method;
        $response = Http::post($url, $params);
        return $response->json();
    }
}
