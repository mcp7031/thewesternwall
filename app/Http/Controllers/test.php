<?php

use App\Http\Controllers\CatalogMessage;
use Core\App;
$db = App::resolve('Core\Database');
$catalogMessage = new CatalogMessage();

$posts = $db->query('select * from `bot_message` ORDER BY `id` DESC')->get();
$catalogMessage->process($posts);
