<x-app-layout>
    {{-- ヘッダーの文字 --}}
    <x-slot name="header">
        <h2 class="font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="text-center pt-16">
        <a href="{{ route('dashboard') }}" class="relative inline-flex items-center justify-start px-6 py-3 overflow-hidden font-medium transition-all bg-indigo-500 rounded-xl group">
            <span class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-indigo-700 rounded group-hover:-mr-4 group-hover:-mt-4">
            <span class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
            </span>
            <span class="relative w-full text-left text-white transition-colors duration-200 ease-in-out group-hover:text-white">あたらしいしーるをとうろくする</span>
        </a>
    </div>
    
</x-app-layout>
