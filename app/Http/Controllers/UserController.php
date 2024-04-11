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
        return view('auth.register', [
            'heading' => $heading,
            'subreg' => 1, // 0=neither subscribed or registered, 1=subscribed, 2=registered,4=forum
            'errors' => $errors
        ]);
    }
    /**
     * Set email registration.
     */
    public function register(Request $request, Member $member) {
        $heading = "Register as Member";
        $errors = null;
        return view('registration.create', [
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
        return response()->file(base_path().'/public/docs/TheWesternWallProject.pdf');
    }
    public function onfreedom()
    {
        return response()->file(base_path().'/public/docs/OnFreedom.pdf');
    }
    public function onfamily()
    {
        return response()->file(base_path().'/public/docs/Families.pdf');
    }
    public function onproperty()
    {
        return response()->file(base_path().'/public/docs/OnProperty.pdf');
    }
    public function onprivatemoney()
    {
        return response()->file(base_path().'/public/docs/OnPrivateMoney.pdf');
    }
    public function privacy()
    {
        return response()->file(base_path().'/public/docs/privacy-policy.pdf');
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
    public function community()
    {
        $heading = "Welcome to the Community page";
        $errors = null;
        return view('/community', [
            'heading' => $heading,
            'errors' => $errors
        ]);
    }

    /**
     * Display the about page
     */
    public function whatwebelieve()
    {
        return response()->file(base_path().'/public/docs/WhatWeBelieve.pdf');
    }

}
