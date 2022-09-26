<?php

namespace App\Classes;


use App\Interfaces\MessengerInterface;
use danog\MadelineProto\API;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TelegramMessenger implements MessengerInterface
{
    public function __construct(API $api){
        $this->messageHandler = new MessageHandler($api);
    }

    /**
     * Send a message to Telegram
     *
     * @return string Return a string response from remote service
     * @throws RemoteServiceException
     * @throws RemoteValidationException
     */
    public function send(array $message,string $peer): Response
    {

        $prossesedRequest = [
            'request'=>[
                'messages' => $message,

                'type'=>'telegram',
                'peer'=> $peer
            ],
            'response'=>'Not completed'
        ];
        $payload = new Payload($prossesedRequest);
        $resp = $this->messageHandler->handle($payload);
        $text =  $resp->getProcessedRequest()['response']['text'];
        Log::info($text);
        return $text;
    }
}
