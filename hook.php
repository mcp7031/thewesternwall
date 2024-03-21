<?php
// Load composer
require_once __DIR__ . '/vendor/autoload.php';
$config = require __DIR__ . '/config.php';
$mysql_credentials = $config['database'];

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($config['bot_api_key'], $config['bot_username']);

    // Enable MySQL
    $telegram->enableMySql($mysql_credentials);
    print("DB enabled: ". $telegram->isDbEnabled());
    // Handle telegram webhook request
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    print($e->getMessage());
}
