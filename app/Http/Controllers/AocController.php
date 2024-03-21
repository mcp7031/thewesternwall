<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Core\App;

// Areas of Concern (Categories)

class AocController extends Controller {

    public $db;

    public function __construct() {
        $this->db = App::resolve('Core\Database');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('aoc.index', [
            'heading' => 'All Categories',
     //       'aocs' => Aoc::latest()->paginate(4)
            'aocs' => DB::table('aocs')->paginate(3)
        ]);
        header('location: /aoc');
        die();
    }

    public function create() {
        return view('aoc.create', [
            'heading' => 'Create Category',
            'errors' => []
        ]);
        header('location: /aoc');
        die();
    }

    public function destroy() {
        /*
        $num = $this->db->query('SELECT COUNT FROM TelegramMessage WHERE aoc_id = :id', ['id' => $_POST['id']]);
        if ($num == 0) {
            */
        $this->db->query('DELETE FROM aocs WHERE id = :id', [
            'id' => $_POST['id']]);
        header('location: /aoc');
        die();
    }

    public function show() {

        $errors = [];
        $aoc = DB::table('aocs')->where('id', $_GET['id'])->first();
        /*       $aoc = $this->db->query('SELECT * FROM aocs WHERE id = :id', [
            'id' => $_GET['id']
        ])->findOrFail();
        $id = $_GET['id'];
        $category = $aoc['category'];
        $description = $aoc['description'];
        $taglist = $aoc['taglist'];
        */
        $id = $_GET['id'];
        $category = $aoc->category;
        $description = $aoc->description;
        $taglist = $aoc->taglist;

        return view("aoc.show", [
            'heading' => 'Edit AOC',
            'id' => $id,
            'errors' => $errors,
            'category' => $category,
            'description' => $description,
            'taglist' => $taglist
        ]);
        header('location: /aoc');
        die();
    }

    public function edit() {
        $errors = [];
        $aoc = $this->db->query('SELECT * FROM aocs WHERE id = :id', [
            'id' => $_GET['id']
        ])->findOrFail();
        $id = $_GET['id'];
        $category = $aoc['category'];
        $description = $aoc['description'];
        $taglist = $aoc['taglist'];

        return view("aoc.edit", [
            'heading' => 'Edit AOC',
            'id' => $id,
            'errors' => $errors,
            'category' => $category,
            'description' => $description,
            'taglist' => $taglist
        ]);
        if (empty($errors)) {
            dd($_POST);
        }
        header('location: /aoc');
        die();
    }

    public function store() {
        $errors = [];
        // put in a validator for contents
        if (! empty($errors)) {
            return view("aoc.create", [
                'heading' => 'Create AOC',
                'errors' => $errors
            ]);
        }
        if ($_SERVER['REQUEST_URI'] === "/aoc") {
            $this->db->query('INSERT INTO aocs (category,description,taglist) VALUES (:category, :description, :taglist)', [
                'category' => $_POST['category'],
                'description' => $_POST['description'],
                'taglist' => $_POST['taglist']
            ]);

        } else {
            $this->db->query('UPDATE aocs SET category = :category,taglist = :taglist,description = :description  WHERE id = :id', [
                'category' => $_POST['category'],
                'description' => $_POST['description'],
                'taglist' => $_POST['taglist'],
                'id' => $_POST['id']
            ]);
        }
        header('location: /aoc');
        die();
    }

}
