<?php

namespace App\Classes;


use App\Interfaces\MessageInterface;
use danog\MadelineProto\API;
use Illuminate\Support\Facades\Log;

class MessageHandler {

    public function __construct(API $api)
    {
        $this->telegram = $api;
    }
    /**
    Handle a payload, send the message
    and return infomation about result

    @return MessageInterface Payload object
     */
    public function handle(MessageInterface $payload): MessageInterface
    {
        $messages = $payload->getMessages();
        $peer = $payload->getProcessedRequest()['request']['peer'];
        foreach($messages as $text){
            try{
                $this->telegram->messages->sendMessage(['peer' => $peer, 'message' => $text]);
            }catch (\Exception $e){
                Log::alert('error processing messages' . $e);
            }
        }
        $newRequest = $payload->getProcessedRequest();
        $newRequest['response'] = [
            'status' => 200,
            'text' => 'Completed'
        ];
        $payload->setProcessedRequest($newRequest);

        return $payload;
    }
}

