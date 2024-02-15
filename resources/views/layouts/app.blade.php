
{{-- ヘッドタグと全体のレイアウト --}}
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

            {{-- navバーを読み込み --}}
            @include('layouts.navigation')

            <!-- navバーの下 -->
            @if (isset($header))
                <header class="bg-pink-200 dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- 各ページのコンテンツ -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
