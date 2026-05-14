<?php

declare(strict_types=1);

namespace Ermeson\BlogApi\Config;

final class AppConfig
{
    public string $appEnv;
    public string $telegramBaseUrl;
    public string $telegramApiToken;
    public string $telegramUsername;

    public function __construct()
    {
        $this->appEnv = getenv('APP_ENV') ?? 'development';
        $this->telegramUsername = getenv('TELEGRAM_USERNAME');
        $this->telegramApiToken = getenv('TELEGRAM_API_TOKEN');
        $this->telegramBaseUrl = "https://api.telegram.org/bot{$this->telegramApiToken}";
    }
}
