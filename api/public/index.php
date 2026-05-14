<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Ermeson\BlogApi\Config\AppConfig;
use Ermeson\BlogApi\DataObject\TelegramSendMessage;
use Ermeson\BlogApi\Http\Requests\ContactRequest;
use Ermeson\BlogApi\Services\TelegramService;
use Ermeson\BlogApi\Infra\DatabaseConnection;

$config = new AppConfig();

$allowedOrigins = $config->appEnv == 'production'
    ? 'https://ermeson.is-a.dev'
    : '*';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: $allowedOrigins");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

$telegramService = new TelegramService($config);

$requestUri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$requsetMethod = $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}

if ($requsetMethod === 'GET' && $requestUri === '/up') {
    http_response_code(200);
    echo json_encode(['ok' => true]);
    exit();
}

if ($requsetMethod == 'POST' && $requestUri == '/contact') {
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

    $messageText = <<<HTML
    <b>📩 Novo Contato no Site</b>

    <b>👤 Nome:</b> {$data['name']}

    <b>📧 E-mail:</b> {$data['email']}

    <b>💬 Mensagem:</b>

    <i>{$data['message']}</i>
    HTML;

    $telegramService->sendMessage(new TelegramSendMessage(
        $config->telegramUsername,
        $messageText
    ));

    http_response_code(200);
    exit();
}

http_response_code(404);
