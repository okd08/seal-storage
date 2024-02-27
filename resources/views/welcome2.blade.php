<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- ファビコン -->
        <link rel="shortcut icon" href="{{ asset('/favicon.svg') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>


    <body class="font-sans antialiased">
        <div class="min-h-screen bg-yellow-50 dark:bg-gray-900">
            {{-- ロゴ --}}
            <img src="/images/logo.png" alt="サイトロゴ" class="pt-6 pb-2 w-1/2 lg:w-1/3 mx-auto">
            <p class="text-center mb-6 text-gray-500">┈୨୧┈フレークシールを管理するツール┈୨୧┈</p>
            {{-- ボタン --}}
            <div class="text-center">
                @if (Route::has('login'))
                    <div class="flex flex-col space-y-4 w-1/4 lg:w-1/5 mx-auto mb-4">
                        {{-- ログインしている場合 --}}
                        @auth
                            <a href="{{ route('home') }}" class="relative inline-flex items-center justify-start px-8 py-3 mt-8 mb-4 overflow-hidden font-medium transition-all bg-yellow-300 rounded-xl group">
                                <span class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-yellow-400 rounded group-hover:-mr-4 group-hover:-mt-4">
                                <span class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                                </span>
                                <span class="relative w-full text-white transition-colors duration-200 ease-in-out group-hover:text-white text-xl lg:text-2xl text-center whitespace-nowrap">ホーム</span>
                            </a>
                        {{-- ログインしていない場合 --}}
                        @else
                            {{-- ログイン --}}
                            <a href="{{ url('login') }}" class="relative inline-flex items-center justify-start px-8 py-3 mt-8 mb-4 overflow-hidden font-medium transition-all bg-sky-300 rounded-xl group">
                                <span class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-sky-400 rounded group-hover:-mr-4 group-hover:-mt-4">
                                <span class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                                </span>
                                <span class="relative w-full text-white transition-colors duration-200 ease-in-out group-hover:text-white text-xl lg:text-2xl text-center whitespace-nowrap">ログイン</span>
                            </a>
                            {{-- 新規登録 --}}
                            @if (Route::has('register'))
                                <a href="{{ url('register') }}" class="relative inline-flex items-center justify-start px-8 py-3 mt-8 mb-4 overflow-hidden font-medium transition-all bg-pink-300 rounded-xl group">
                                    <span class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-pink-400 rounded group-hover:-mr-4 group-hover:-mt-4">
                                        <span class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                                    </span>
                                    <span class="relative w-full text-white transition-colors duration-200 ease-in-out group-hover:text-white text-xl lg:text-2xl text-center whitespace-nowrap">新規登録</span>
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
