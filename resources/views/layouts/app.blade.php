<!DOCTYPE html>
<html data-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @isset($title)
                {{ $title }} -
            @endisset
            {{ config('app.name', 'Laravel') }}
        </title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            @if (isset($header))
                <header class="shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h2 class="font-semibold text-xl leading-tight">
                        {{ $header }}
                        </h2>
                    </div>
                </header>
            @endif

            <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lb:px-8">
                {{ $slot }}
            </main>
        </div>

        @if(Session::has('info'))
            <div class="toast">
                <div class="alert alert-info">
                    <div>
                        <span>{{Session::get('info')}}</span>
                    </div>
                </div>
            </div>§
        @endif
    </body>
</html>
