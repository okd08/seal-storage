<x-app-layout>
  {{-- ページタイトル --}}
  @section('title', 'シール詳細')
  {{-- パンくず --}}
  {{ Breadcrumbs::render('show', $seal) }}
  {{-- フラッシュメッセージを読み込み --}}
  @include('flash::message')

  {{-- シール詳細 --}}
  <form action="{{ route('seals.index') }}" method="GET">
  <div class="py-20">
    {{-- 画像 --}}
    <div class="mx-auto mb-4" style="width: 40%; padding-top: 40%; position: relative;">
      <img src="{{ $seal->image }}" alt="{{ $seal->name }}" class="rounded border-2 border-yellow-300" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
    </div>
    {{-- パッケージ --}}
    <div class="flex justify-center">
      <button type="submit" name="package" value="{{ $seal->package_id }}" class="font-bold text-gray-500 hover:text-pink-300 mb-2">{{ $seal->package->name }}</button>
    </div>
    {{-- 名前 --}}
    <p class="text-xl text-center mb-10">{{ '『 ' . $seal->name . ' 』' }}</p>
    {{-- タグ --}}
    <div class="w-8/12 mx-auto px-4 py-2 bg-white rounded-xl flex flex-wrap">
      <p class="text-gray-400 mr-3">タグ</p>
      @foreach ($seal['tags'] as $st)
      <div class="mr-3 hover:text-sky-300">
        <button type="submit" name="keyword" value="{{ $st['name'] }}">{{ '#' . $st['name'] }}</button>
      </div>
      @endforeach
    </div>
  </div>
  </form>
</x-app-layout>