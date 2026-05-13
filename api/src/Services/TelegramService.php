<?php

declare(strict_types=1);

namespace Ermeson\BlogApi\Services;

use Ermeson\BlogApi\Config\AppConfig;
use Ermeson\BlogApi\DataObject\TelegramSendMessage;
use function strlen;

final class TelegramService
{
    public function __construct(private readonly AppConfig $appConfig)
    {
    }

    public function sendMessage(TelegramSendMessage $message): void
    {
        $payload = json_encode($message->toArray());

        $ch = curl_init($this->appConfig->telegramBaseUrl . '/sendMessage');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        ]);

        $response = curl_exec($ch);
        unset($ch);
    }
}
