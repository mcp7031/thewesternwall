<?php

namespace App\CustomClasses;

use Illuminate\Support\Facades\DB;
use Core;
use App\Models\TelegramPosts;
use Longman\TelegramBot\Entities\Message as BotMsg;

class CatalogMessage extends BotMsg {

    protected $db;
    public $id;
    public $categories;
    public $category;
    public $title;
    public $keywords;
    public $excerpt;
    public $caption;
    public $body;
    public $link;
    public $hashtag;
    public $date;
    public $published_dt;
    public $aocKeyMap;
    protected $update;

    public function __construct() {
        $this->db = Core\App::resolve('Core\Database');
        $aocs = DB::table('aocs')->get();
        foreach ($aocs as $aoc) {
            $this->aocKeyMap[$aoc->category] = $aoc->id;
            $this->categories[$aoc->category] = $aoc->taglist;
        }
    }
    public function nl2html($text)
    {
        return '<p>' . preg_replace(array('/(\r\n\r\n|\r\r|\n\n)(\s+)?/', '/\r\n|\r|\n/'),
            array('</p><p>', '<br/>'), $text) . '</p>';
    }

    public function processUpdate($post) {
        $this->update = $post;
        $item = $post->text ?? $post->caption;
        if ($item == '') return;
        $this->id = $post->id;
        $text = strlen($item) > 50 ? substr($item, 0, 50) . '...' : $item;
        if ($text <> '') $text = $this->nl2html($text);
        $this->title = $text;
        $errors = [];
        // loop over all Telegram messages
        // check if already processed
        // determine a title, excerpt, slug and category
        // write to file and flag original message
        $httpClient = new \GuzzleHttp\Client();
        // $categories = require(base_path() . '/category_list');
        //		print_r($post);

        // $item = $this->update->getMessage();
        // $this->caption = $this->update->getCaption();
        $this->body = $this->nl2html($item);
        $this->caption = $post->caption;
        $this->category = $item['forum_topic_created']['name'] ?? '';
        //    $dt = DateTime::createFromFormat('Y-m-d H:i:s', $post->date);
        $dt = $post->date;
        if($this->caption <> '') $this->caption = $this->nl2html($this->caption);
        // Parse text and URL
        preg_match('/(.*?)(https?:\/\/\S+)/', $item, $matches);
        $isURL=false;
        //dd($matches);
        for ($i=0; $i<3; $i++) {
            $temp = $matches[$i] ??  '';
            if($temp <> '') $isURL = filter_var($temp, FILTER_VALIDATE_URL);
            if ($isURL) $this->link = $temp;
        }
        // Tokenize input text into words
        $words = preg_split('/[\s,]+/', strtolower($item));
        $morewords = preg_split('/[-]/', strtolower($item));
        if ($words == '') {
            return null;
        }
        // Initialize variables to keep track of the category with the most matches and matched words for each category
        $maxMatches = 0;
        $bestCategory = '';
        $matchedWords = [];
        // Check each category's word list for matches with the input text
        if ( $this->categories != null ) {
            foreach ($this->categories as $category => $wordList) {
                $tags = explode(',',$wordList);
                $matches = array_intersect($tags, $words);
                $numMatches = count($matches);
                // Update best category and matched words if more matches are found
                //     print_r("Cat:".$category.' '.$numMatches);
                if ($numMatches > $maxMatches) {
                    $maxMatches = $numMatches;
                    $bestCategory = $category;
                    $matchedWords = $matches;
                }
            }
        }
        if ($bestCategory == '') $bestCategory = "Other";
        // Output result
        $outString[] = [
            //  "Input" => $item,
            "category" => $bestCategory,
            "keywords" => '#' . implode('#', $matchedWords),
            "excerpt" => $item,
            "date" => $dt
        ];
        if(empty($this->category)) $this->category = $bestCategory;
        $this->keywords = '#' . implode('#', $matchedWords);
        $this->excerpt = $item;
        $this->date = $dt;
        $this->published_dt = date('Y-m-d H:i:s');
         // dd([$this, $post]);
        $telegram_post = DB::table('TelegramPosts')->find($this->id);
        if ($telegram_post <> '') return;
        if (empty($errors)) {
            $telegram_post = new TelegramPosts ([
                    'id' => $this->id,
                    'body' => $this->body,
                    'user_id' => 1,
                    'aoc_id' => $this->aocKeyMap[$this->category],
                    'title' => $this->title,
                    'excerpt' => $this->excerpt,
                    'link' => $this->link,
                    'published_at' => $this->date,
                    'hashtag' => $this->keywords
            ]);
            $telegram_post->save();
            /*
            $this->db->query('INSERT INTO TelegramMessage (id,user_id,aoc_id,title,excerpt,body,link,published_at,slug,hashtag)
                VALUES(:id,:user_id,:aoc_id,:title,:excerpt,:body,:link,:published_at,:slug,:hashtag)', [
                    'id' => $this->id,
                    'body' => $this->body,
                    'user_id' => 1,
                    'aoc_id' => $this->aocKeyMap[$this->category],
                    'title' => $this->title,
                    'excerpt' => $this->excerpt,
                    'link' => $this->link,
                    'published_at' => $this->date,
                    'hashtag' => $this->keywords
                ]);
            */
        }
        return $this;
    }

    function get_youtube($url) {

    }

    function debug_to_console($data) {

        $output = print_r($data, true);

        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

}
