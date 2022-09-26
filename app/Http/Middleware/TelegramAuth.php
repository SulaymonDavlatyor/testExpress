<?php

namespace App\Http\Middleware;

use Closure;
use danog\MadelineProto\API;
use danog\MadelineProto\MTProtoSession\Session;
use danog\MadelineProto\Settings;
use danog\MadelineProto\Settings\AppInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TelegramAuth
{

    public function __construct(API $api)
    {
        $this->telegram = $api;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if ($this->telegram->getSelf()) {
            return $next($request);
        }

        $telegramToken = $request->header('TelegramToken');

        if ($telegramToken) {

            $this->telegram->completePhoneLogin($telegramToken);
            return $next($request);
        }

        $phone = $request->get('phone_number');
        $api_id = $request->get('api_id');
        $api_hash = $request->get('api_hash');

        $settings = new Settings();
        $settings->setAppInfo((new AppInfo())->setApiId($api_id)->setApiHash($api_hash));
        $this->telegram->updateSettings($settings);
        $this->telegram->phoneLogin($phone);


        return new Response('Continue using telegram token as header TelegramToken', 401);


    }
}
