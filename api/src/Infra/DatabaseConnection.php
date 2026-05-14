<?php

declare(strict_types=1);

namespace Ermeson\BlogApi\Infra;

final class DatabaseConnection
{
    public static function open(): \PDO
    {
        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');

        if (!$host || !$dbname || !$user || $password === false) {
            throw new \RuntimeException('Missing database configuration environment variables.');
        }

        return new \PDO(
            "pgsql:host={$host};dbname={$dbname}",
            $user,
            $password
        );
    }
}
