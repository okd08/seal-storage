<x-app-layout>
  {{-- ページタイトル --}}
  @section('title', 'パッケージ管理')
  {{-- パンくず --}}
  {{ Breadcrumbs::render('index2') }}
  {{-- フラッシュメッセージを読み込み --}}
  @include('flash::message')

  <div class="w-8/12 lg:w-4/12 mx-auto pt-20">
    <p class="text-bold text-lg mb-6 font-bold text-center">┈୨୧┈ パッケージ管理 ┈୨୧┈</p>
    @foreach ($packages as $p)
      <div class="flex bg-white rounded-lg border-2 border-yellow-200 text-lg font-bold py-2 px-3 mb-3">
        <p class="mr-5">{{ $p->id . '.' }}</p>
        <p class="mr-2">{{ $p->name }}</p>
        <a href="{{ route('packages.edit', $p) }}" class="ml-auto bg-sky-300 hover:bg-sky-400 px-3 text-white rounded">編集</a>
      </div>
    @endforeach
  </div>
</x-app-layout>