<x-app-layout>
    {{-- ヘッダーの文字 --}}
    <x-slot name="header">
        <h2 class="font-semibold text-gray-600 dark:text-gray-200 leading-tight">
            ほーむ
        </h2>
    </x-slot>

    {{-- 登録ボタン --}}
    <div class="text-center">
        <a href="{{ route('items.create') }}" class="relative inline-flex items-center justify-start px-6 py-3 mt-12 overflow-hidden font-medium transition-all bg-indigo-500 rounded-xl group">
            <span class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-indigo-700 rounded group-hover:-mr-4 group-hover:-mt-4">
            <span class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
            </span>
            <span class="relative w-full text-left text-white transition-colors duration-200 ease-in-out group-hover:text-white">あたらしいしーるをとうろくする</span>
        </a>
    </div>
    {{-- カテゴリ、タグ --}}
    <div class="text-center">
        <a href="{{ route('items.create') }}" class="relative inline-flex items-center justify-start px-5 py-1 mt-8 mb-4 overflow-hidden font-medium transition-all bg-blue-300 rounded-xl group">
            <span class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-blue-400 rounded group-hover:-mr-4 group-hover:-mt-4">
            <span class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
            </span>
            <span class="relative w-full text-left text-white transition-colors duration-200 ease-in-out group-hover:text-white">ぱっけーじのかんり</span>
        </a>
        <a href="{{ route('items.create') }}" class="relative inline-flex items-center justify-start px-5 py-1 mt-8 mb-4 overflow-hidden font-medium transition-all bg-pink-300 rounded-xl group">
            <span class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-pink-400 rounded group-hover:-mr-4 group-hover:-mt-4">
            <span class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
            </span>
            <span class="relative w-full text-left text-white transition-colors duration-200 ease-in-out group-hover:text-white">かてごりのかんり</span>
        </a>
    </div>
    {{-- 検索 --}}
    <div class="flex justify-center">
        <div class="relative flex items-center w-2/3">
            <svg class="absolute left-0 z-20 w-4 h-4 ml-4 text-yellow-400 pointer-events-none fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
                </path>
            </svg>
            <input type="text" class="block w-full py-1.5 pl-10 pr-4 leading-normal rounded-2xl focus:border-transparent focus:outline-none focus:ring-2 focus:ring-yellow-400 ring-opacity-90 bg-white dark:bg-gray-800 text-gray-400 aa-input" placeholder="けんさく"/>
        </div>
    </div>

    {{-- シール一覧 --}}
    {{-- <section class="text-gray-600 body-font flex mb-4">
        <div class="container px-5 mx-auto w-1/3">
            <div class="flex flex-wrap -m-4">
                <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                    <img class="h-48 w-48 object-cover object-center" src="https://dummyimage.com/720x400">
                    <div class="p-6">
                        <h1 class="title-font text-lg font-medium text-gray-900 mb-3">パッケージ名</h1>
                        <p class="leading-relaxed mb-3">#タグ #一覧</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container px-5 mx-auto w-1/3">
            <div class="flex flex-wrap -m-4">
                <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                    <img class="h-48 w-48 object-cover object-center" src="https://dummyimage.com/720x400">
                    <div class="p-6">
                        <h1 class="title-font text-lg font-medium text-gray-900 mb-3">パッケージ名</h1>
                        <p class="leading-relaxed mb-3">#タグ #一覧</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container px-5 mx-auto w-1/3">
            <div class="flex flex-wrap -m-4">
                <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                    <img class="h-48 w-48 object-cover object-center" src="https://dummyimage.com/720x400">
                    <div class="p-6">
                        <h1 class="title-font text-lg font-medium text-gray-900 mb-3">パッケージ名</h1>
                        <p class="leading-relaxed mb-3">#タグ #一覧</p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    
</x-app-layout>
