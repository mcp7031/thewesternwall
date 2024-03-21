<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Set email subscription.
     */
    public function subscribe(Request $request, Member $member) {
        $heading = "Subscribe to Mailing List";
        $errors = null;
        return view('/registration/create', [
            'heading' => $heading,
            'errors' => $errors
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the about page
     */
    public function about()
    {
        $heading = "Welcome to the Western Wall Project";
        $errors = null;
        return view('/about', [
            'heading' => $heading,
            'errors' => $errors
        ]);
    }
    public function aboutRTV()
    {
        $heading = "Welcome to the About RTV page";
        $errors = null;
        return view('/aboutRTV', [
            'heading' => $heading,
            'errors' => $errors
        ]);
    }

    /**
     * Display the about page
     */
    public function whatwebelieve()
    {
        $heading = "Welcome to the About page";
        $errors = null;
        return view('/whatwebelieve', [
            'heading' => $heading,
            'errors' => $errors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        dd(["In controller function create", $request]);
        $heading = "Register as Member";
        $errors = null;
        return view('/registration/create', [
            'heading' => $heading,
            'errors' => $errors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd(["In controller function store", $request]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }
}
