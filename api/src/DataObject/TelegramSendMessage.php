<?php

declare(strict_types=1);

namespace Ermeson\BlogApi\DataObject;

final readonly class TelegramSendMessage
{
    public function __construct(
        public string $chatId,
        public string $text,
        public string $parseMode = 'HTML'
    )
    {
    }

    public function toArray(): array
    {
        return [
            'chat_id' => $this->chatId,
            'text' => $this->text,
            'parse_mode' => $this->parseMode
        ];
    }
}
