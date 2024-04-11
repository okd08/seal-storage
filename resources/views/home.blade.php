<x-app-layout>
    {{-- ページタイトル --}}
    @section('title', 'ホーム')
    {{-- パンくず --}}
    {{ Breadcrumbs::render('home') }}
    {{-- フラッシュメッセージを読み込み --}}
    @include('flash::message')

    {{-- 一覧 --}}
    <div class="text-center mt-20">
        <a href="{{ route('seals.index') }}" class="relative inline-flex items-center justify-start px-20 py-10 mt-8 mb-4 overflow-hidden font-medium transition-all bg-sky-300 rounded-xl group active:bg-sky-200">
            <span class="absolute top-0 right-0 inline-block w-10 h-10 transition-all duration-500 ease-in-out bg-pink-300 rounded-bl group-hover:-mr-10 group-hover:-mt-10">
            <span class="absolute top-0 right-0 w-14 h-14 rotate-45 translate-x-1/2 -translate-y-1/2 bg-yellow-50"></span>
            </span>
            <span class="relative w-full text-white transition-colors duration-200 ease-in-out group-hover:text-white text-2xl lg:text-3xl text-center whitespace-nowrap">シール一覧</span>
        </a>
    </div>
    {{-- 登録 --}}
    <div class="text-center mt-2">
        <a href="{{ route('seals.create') }}" class="relative inline-flex items-center justify-start px-5 py-8 mt-8 mb-4 overflow-hidden font-medium transition-all bg-pink-300 rounded-xl group active:bg-pink-200">
            <span class="absolute top-0 right-0 inline-block w-7 h-7 transition-all duration-500 ease-in-out bg-yellow-300 rounded-bl group-hover:-mr-10 group-hover:-mt-10">
            <span class="absolute top-0 right-0 w-10 h-10 rotate-45 translate-x-1/2 -translate-y-1/2 bg-yellow-50"></span>
            </span>
            <span class="relative w-full text-white transition-colors duration-200 ease-in-out group-hover:text-white text-xl lg:text-2xl text-center whitespace-nowrap">新しいシールを登録する</span>
        </a>
    </div>
</x-app-layout>
