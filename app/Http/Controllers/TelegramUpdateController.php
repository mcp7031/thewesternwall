<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Exception\TelegramException;
use App\Models\Message;
use Longman\TelegramBot\DB;
use PDO;
use PDOException;

class TelegramUpdateController extends Controller
{
    // Create Telegram API object
    protected static $telegram;
    protected static $config;
    protected static $mysql_credentials;
    protected static $pdo;
    protected static $sql;

    public function __construct() {
        $limit=0;
        self::$config = require __DIR__ . '/config.php';
        self::$mysql_credentials = self::$config['database'];
        self::$telegram = new Telegram(self::$config['bot_api_key'], self::$config['bot_username']);
        self::$pdo = DB::initialize(self::$mysql_credentials, self::$telegram);
        self::$sql = ' SELECT * FROM `bot_message` ORDER BY `id` DESC ';

        if ($limit > 0) {
            $sql .= ' LIMIT :limit';
        }
    }

    static function getUpdates() {

        try {
            // Enable MySQL
            self::$telegram->enableMySql(self::$mysql_credentials);
            // Handle telegram getUpdates request
            self::$telegram->handleGetUpdates();
        } catch (TelegramException $e) {
            // log telegram errors
            echo $e->getMessage();
        }
    }
    static function index() {
        $limit=0;
        if (!DB::isDbConnected()) {
            return false;
        }
        $sth = self::$pdo->prepare(self::$sql);

        if ($limit > 0) {
            $sth->bindValue(':limit', $limit, PDO::PARAM_INT);
        }
        try{
            $sth->execute();
            $posts=$sth->fetchAll();
        } catch (PDOException $e) {
            throw new TelegramException($e->getMessage());
        }
        return view('index', [
            'title' => 'All Posts',
            'posts' => $posts
        ]);
    }

    static function getTelegramPosts() {
        /*

        $notes = $db->query('select * from notes where user_id = 1')->get();

        view("notes/index.view.php", [
             'heading' => 'My Notes',
             'notes' => $notes
        ]);
        */
        return;
    }
}
