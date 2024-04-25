<?php

namespace App\Http\Controllers;

use App\CustomClasses\BotMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\CustomClasses\CatalogMessage;
use App\Models\Carts;
use Longman\TelegramBot\Entities\Message as BotMsg;
use Core;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Entities\User;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\DB as TDB;

class MessageController extends Controller
{
    protected $db;
    protected $catalogMessage;
    protected $telegram;
    protected $commands_objects;
    protected $chats;
    protected $messages;
    public $aocKeyMap;
    public $cart;


    public function __construct() {
        $this->db = Core\App::resolve('Core\Database');
        $this->catalogMessage = new CatalogMessage();
        $this->aocKeyMap = $this->catalogMessage->aocKeyMap;
        $this->cart = new Carts();
    }

    protected function setUp() : ServerResponse {
        $config = require base_path('/config.php');
        $mysql_credentials = $config['database'];

        try {
            // Create Telegram API object
            $this->telegram = new Telegram($config['bot_api_key'], $config['bot_username']);
            // Enable MySQL
            $this->telegram->enableMySql($mysql_credentials);
            //    $this->telegram->isDbEnabled();
            // Handle telegram getUpdates request
            $response = $this->telegram->handleGetUpdates();
            if ($response->isOk()) {
                $numUpdates = count($response->getResult());
          //      print("Processed " . $numUpdates . " updates");

            }
        } catch (TelegramException $e) {
            // log telegram errors
            echo $e->getMessage();
        }
        return $response;
    }

    public function index() {

        $response = $this->setup();
        //Make sure we have an up-to-date command list
        //This is necessary to "require" all the necessary command files!
        $this->commands_objects = $this->telegram->getCommandsList();
        $this->chats = TDB::selectChats(['supergroups', 'channels']);
        $this->messages = TDB::selectMessages();
        if ($response->isOk()) {
            // Process all updates
            /** @var Update $update */
            /*
            foreach ($response->getResult() as $update) {
                $this->catalogMessage->processUpdate($update);
            }
            */
            foreach ($this->messages as $message) {
                $this->catalogMessage->processUpdate($message);
            }
        }
        // $posts = $this->db->query('select * from `bot_message` ORDER BY `date` DESC')->get();
        // dd([$posts, is_object($posts)]);
        return view('index', [
            'cart' => $this->cart
        ]);
            /*, [
            'heading' => 'Telegram Posts',
            'aocList' => $this->aocKeyMap,
            'posts' => TelegramPosts::latest()->paginate(3)
            ]);
            */
    }
/*
    public function show(Message $post) {
        return view('show', [
            'post' => $post,
            'comments' => $post->comments()->with('user')->paginate(10),
        ]);
    }
    */
}
