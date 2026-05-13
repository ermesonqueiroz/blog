<?php

declare(strict_types=1);

use Ermeson\BlogApi\Http\Requests\ContactRequest;

test('required fields', function (string $field) {
    $payload = [
        'name' => 'Test Name',
        'email' => 'test@example.com',
        'message' => 'lorem ipsum'
    ];

    unset($payload[$field]);
    $result = ContactRequest::validate($payload);

    expect($result)->toBeFalsy();
})->with(['name', 'email', 'message']);
