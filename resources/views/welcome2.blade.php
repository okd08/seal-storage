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
            <p class="text-center mb-6 text-gray-500">┈୨୧┈ フレークシールを管理するためのツール ┈୨୧┈</p>
            {{-- ボタン --}}
            <div class="text-center">
                @if (Route::has('login'))
                    <div class="flex flex-col space-y-4 w-1/3 lg:w-1/5 mx-auto mb-4">
                        {{-- ログインしている場合 --}}
                        @auth
                            <a href="{{ route('home') }}" class="relative inline-flex items-center justify-start px-8 py-3 mt-8 mb-4 overflow-hidden font-medium transition-all bg-yellow-300 rounded-xl group active:bg-yellow-200">
                                <span class="absolute top-0 right-0 inline-block w-6 h-6 transition-all duration-500 ease-in-out bg-sky-300 rounded-bl group-hover:-mr-6 group-hover:-mt-6">
                                <span class="absolute top-0 right-0 w-8 h-8 rotate-45 translate-x-1/2 -translate-y-1/2 bg-yellow-50"></span>
                                </span>
                                <span class="relative w-full text-white transition-colors duration-200 ease-in-out group-hover:text-white text-xl lg:text-2xl text-center whitespace-nowrap">ホーム</span>
                            </a>
                        {{-- ログインしていない場合 --}}
                        @else
                            {{-- ログイン --}}
                            <a href="{{ url('login') }}" class="relative inline-flex items-center justify-start px-8 py-3 mt-8 mb-4 overflow-hidden font-medium transition-all bg-sky-300 rounded-xl group active:bg-sky-200">
                                <span class="absolute top-0 right-0 inline-block w-6 h-6 transition-all duration-500 ease-in-out bg-yellow-200 rounded-bl group-hover:-mr-6 group-hover:-mt-6">
                                <span class="absolute top-0 right-0 w-8 h-8 rotate-45 translate-x-1/2 -translate-y-1/2 bg-yellow-50"></span>
                                </span>
                                <span class="relative w-full text-white transition-colors duration-200 ease-in-out group-hover:text-white text-xl lg:text-2xl text-center whitespace-nowrap">ログイン</span>
                            </a>
                            {{-- 新規登録 --}}
                            {{-- @if (Route::has('register'))
                                <a href="{{ url('register') }}" class="relative inline-flex items-center justify-start px-8 py-3 mt-8 mb-4 overflow-hidden font-medium transition-all bg-pink-300 rounded-xl group active:bg-pink-200">
                                    <span class="absolute top-0 right-0 inline-block w-6 h-6 transition-all duration-500 ease-in-out bg-yellow-200 rounded-bl group-hover:-mr-6 group-hover:-mt-6">
                                        <span class="absolute top-0 right-0 w-8 h-8 rotate-45 translate-x-1/2 -translate-y-1/2 bg-yellow-50"></span>
                                    </span>
                                    <span class="relative w-full text-white transition-colors duration-200 ease-in-out group-hover:text-white text-center text-lg lg:text-2xl whitespace-nowrap">新規登録</span>
                                </a>
                            @endif --}}
                        @endauth
                    </div>
                @endif
            </div>

            <div class="w-8/12 lg:w-5/12 mx-auto text-center py-10">
                <p class="mb-5 py-2 px-10 rounded-full border-dashed border-4 border-pink-200 bg-white">かわいいシールを集めるのが好き!<br>でも、フレークシールは1枚ずつファイルに入れるとかさばるし、いちいち袋から出して見るのも面倒…。<br>そんな思いをきっかけに作ったシステムです。</p>
                <img src="/images/seal.jpg">
                <p class="font-bold mt-5">☆工夫した点☆</p>
                <p>・画像をたくさん投稿するため、保存先はS3にした。</p>
                <p>・JavaScriptを使用し、画像のプレビューやタグの追加/削除を動的に行えるようにした。</p>
                <p>・パッケージ名やタグ名をクリックするだけで検索ができるようにして、webならではの利便性を高めた。</p>
                <a href="https://github.com/okd08/seal-storage.git" target="_blank" title="GitHubリンク" class="flex items-center justify-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="text-xl transition-colors duration-200 hover:text-yellow-400 dark:hover:text-white" viewBox="0 0 1792 1792"><path d="M896 128q209 0 385.5 103t279.5 279.5 103 385.5q0 251-146.5 451.5t-378.5 277.5q-27 5-40-7t-13-30q0-3 .5-76.5t.5-134.5q0-97-52-142 57-6 102.5-18t94-39 81-66.5 53-105 20.5-150.5q0-119-79-206 37-91-8-204-28-9-81 11t-92 44l-38 24q-93-26-192-26t-192 26q-16-11-42.5-27t-83.5-38.5-85-13.5q-45 113-8 204-79 87-79 206 0 85 20.5 150t52.5 105 80.5 67 94 39 102.5 18q-39 36-49 103-21 10-45 15t-57 5-65.5-21.5-55.5-62.5q-19-32-48.5-52t-49.5-24l-20-3q-21 0-29 4.5t-5 11.5 9 14 13 12l7 5q22 10 43.5 38t31.5 51l10 23q13 38 44 61.5t67 30 69.5 7 55.5-3.5l23-4q0 38 .5 88.5t.5 54.5q0 18-13 30t-40 7q-232-77-378.5-277.5t-146.5-451.5q0-209 103-385.5t279.5-279.5 385.5-103zm-477 1103q3-7-7-12-10-3-13 2-3 7 7 12 9 6 13-2zm31 34q7-5-2-16-10-9-16-3-7 5 2 16 10 10 16 3zm30 45q9-7 0-19-8-13-17-6-9 5 0 18t17 7zm42 42q8-8-4-19-12-12-20-3-9 8 4 19 12 12 20 3zm57 25q3-11-13-16-15-4-19 7t13 15q15 6 19-6zm63 5q0-13-17-11-16 0-16 11 0 13 17 11 16 0 16-11zm58-10q-2-11-18-9-16 3-14 15t18 8 14-14z"></path></svg>
                </a>
            </div>
        </div>
    </body>
</html>
