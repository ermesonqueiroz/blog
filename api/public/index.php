<?php

use Ermeson\BlogApi\Http\Requests\ContactRequest;
use Ermeson\BlogApi\Infra\DatabaseConnection;

require_once __DIR__ . '/../vendor/autoload.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requsetMethod = $_SERVER['REQUEST_METHOD'];

if ($requsetMethod === 'GET' && ($requestUri === '/up' || $requestUri === '/api/up')) {
    http_response_code(200);
    echo json_encode(['ok' => true]);
    exit();
}

if ($requsetMethod === 'POST' && $requestUri === '/contact') {
    $db = DatabaseConnection::open();
    $body = json_decode(file_get_contents('php://input'), true);
    $data = ContactRequest::validate($body);

    if (!$data) {
        http_response_code(422);
        exit();
    }

    $sql = "INSERT INTO contact_submissions (name, email, message) VALUES (:name, :email, :message)";
    $db->prepare($sql)->execute([
        ':name' => $data['name'],
        ':email' => $data['email'],
        ':message' => $data['message'],
    ]);

    http_response_code(200);
}

http_response_code(404);
