<?php

namespace App\Classes;

use App\Interfaces\MessageInterface;

class Payload implements MessageInterface
{

    public function __construct(
        private array  $prossesedRequest
    ){}

    /**
     * Get the type of a message
     *
     * @return string Following types: "messenger:(telegram|whatsapp)", "push"
     */
    public function getType(string $message): string
    {
        return $this->prossesedRequest['request']['type'];
    }

    /**
     * Get messages from payload
     *
     * @return array ["message text N""]
     */
    public function getMessages(): array
    {
        return $this->prossesedRequest['request']['messages'];
    }

    public function setProcessedRequest(array $data):void
    {
        $this->prossesedRequest = $data;
    }



    /**
     * Get information about processing the payload
     *
     * @return array ["request" => "body", "response" => "body"]
     */
    public function getProcessedRequest(): array
    {
        return $this->prossesedRequest;

    }
}
