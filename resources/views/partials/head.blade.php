<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
        <!--    <link rel="stylesheet" href="{{ asset('/resourcs/catalog/font-awesome-4.7.0/css/font-awesome.min.css') }}"> -->
        <script src="https://kit.fontawesome.com/8f129fff9f.js" crossorigin="anonymous"></script>
        <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.1/dist/cdn.min.js"
    ></script>

        <title>{{ 'TheWesternWall' }}</title>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
