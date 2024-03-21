<?php
/**
 * This file is part of the PHP Telegram Bot example-bot package.
 * https://github.com/php-telegram-bot/example-bot/
 *
 * (c) PHP Telegram Bot Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This file is used to run the bot with the getUpdates method.
 */
// Load composer
require_once __DIR__ . '/vendor/autoload.php';
// Load all configuration options
/** @var array $config */
$config = require __DIR__ . '/config.php';
$mysql_credentials = $config['database'];



try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($config['bot_api_key'], $config['bot_username']);
    // Enable MySQL
    $telegram->enableMySql($mysql_credentials);
    $response = $telegram->handleGetUpdates();
    if ($response->isOk()) {
        $numUpdates = count($response->getResult());
        print("Processed " . $numUpdates . "updates");
        print_r($response);

    }
    // Handle telegram getUpdates request
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
    echo $e->getMessage();
}

/**
     * Check `hook.php` for configuration code to be added here.
     */

