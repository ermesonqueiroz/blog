<?php

declare(strict_types=1);

namespace Ermeson\BlogApi\Http\Requests;

final class ContactRequest
{
    public static function validate(array $data): array|bool
    {
        if (empty(trim($data['name'] ?? ''))) {
            return false;
        }

        $email = trim($data['email'] ?? '');
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        if (empty(trim($data['message'] ?? ''))) {
            return false;
        }

        return $data;
    }
}
