<x-app-layout>
  {{-- ページタイトル --}}
  @section('title', 'シール詳細')
  {{-- パンくず --}}
  {{ Breadcrumbs::render('show', $seal) }}
  {{-- フラッシュメッセージを読み込み --}}
  @include('flash::message')

  {{-- シール詳細 --}}
  <form action="{{ route('seals.index') }}" method="GET" class="pb-20">
    <div class="pt-20">
      {{-- 画像 --}}
      <div class="mx-auto mb-4" style="width: 70%; padding-top: 70%; position: relative;">
        <img src="{{ $seal->image }}" alt="{{ $seal->name }}" class="rounded border-2 border-yellow-300" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
      </div>
      {{-- パッケージ --}}
      <div class="flex justify-center">
        <button type="submit" name="package" value="{{ $seal->package_id }}" class="font-bold text-gray-500 hover:text-pink-300 mb-2">{{ $seal->package->name }}</button>
      </div>
      {{-- 名前 --}}
      <p class="text-xl text-center mb-10">{{ '『 ' . $seal->name . ' 』' }}</p>
      {{-- タグ --}}
      <div class="w-8/12 mx-auto px-4 py-2 bg-white rounded-xl flex flex-wrap mb-10">
        <p class="text-gray-400 mr-3">タグ</p>
        @foreach ($seal['tags'] as $st)
        <div class="mr-3 hover:text-sky-300">
          <button type="submit" name="keyword" value="{{ $st['name'] }}">{{ '#' . $st['name'] }}</button>
        </div>
        @endforeach
      </div>
    </div>

    {{-- 編集画面リンク --}}
    <div class="w-2/12 lg:w-1/12 mx-auto text-center bg-sky-300 hover:bg-sky-400 rounded-lg py-2">
      <a href="{{ route('seals.edit', $seal) }}" class="text-lg font-bold text-white">編集</a>
    </div>
  </form>
</x-app-layout>