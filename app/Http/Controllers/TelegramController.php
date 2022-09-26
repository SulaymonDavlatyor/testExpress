<?php

namespace App\Http\Controllers;

use App\Classes\TelegramMessenger;
use danog\MadelineProto\API;
use danog\MadelineProto\MyTelegramOrgWrapper;
use danog\MadelineProto\Settings;
use danog\MadelineProto\Settings\AppInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{

    public function __construct(API $api)
    {

        $this->messenger = new TelegramMessenger($api);
    }


    public function sendMessage(Request $request)
    {

        $response = $this->messenger->send($request->get('messages'), $request->get('peer'));

        Log::info('Payload finsihed ' . $response);
        return new Response($response,200);
    }
}
