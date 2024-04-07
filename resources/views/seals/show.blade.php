<x-app-layout>
  {{-- ページタイトル --}}
  @section('title', 'シール詳細')
  {{-- パンくず --}}
  {{ Breadcrumbs::render('show', $seal) }}

  {{-- シール詳細 --}}
  <div class="py-20">
    {{-- 画像 --}}
    <div class="mx-auto mb-4" style="width: 40%; padding-top: 40%; position: relative;">
      <img src="{{ $seal->image }}" alt="{{ $seal->name }}" class="rounded border-2 border-yellow-300" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
    </div>
    {{-- パッケージ --}}
    <a href="" class="w-10/12 mx-auto mb-4">
      <p class="text-gray-500 text-md text-center hover:text-pink-300">{{ $seal->package->name }}</p>
    </a>
    {{-- 名前 --}}
    <p class="text-xl text-center mb-10">{{ '『 ' . $seal->name . ' 』' }}</p>
    {{-- タグ --}}
    <div class="w-8/12 mx-auto px-4 py-2 bg-white rounded-xl flex flex-wrap">
      <p class="text-gray-400 mr-3">タグ</p>
      @foreach ($seal['tags'] as $st)
      <div class="mr-3 hover:text-sky-300">
        <a href="">{{ '#' . $st['name'] }}</a>
      </div>
      @endforeach
    </div>
  </div>
</x-app-layout>