<x-app-layout>
  {{-- ページタイトル --}}
  @section('title', 'シール詳細')
  {{-- パンくず --}}
  {{ Breadcrumbs::render('show', $seal) }}
  {{-- フラッシュメッセージを読み込み --}}
  @include('flash::message')

  <div class="py-20">
    <div class="flex justify-center mb-1">
      {{-- 名前 --}}
      <p class="text-xl">{{ '『 ' . $seal->name . ' 』' }}</p>
      {{-- お気に入り --}}
      <form action="{{ route('seals.favorite', $seal->id) }}" method="POST">
        @csrf
        @method('PATCH')
          @if ($seal->favorite == 0)
            <button type="submit" title="お気に入り解除">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-pink-400 mt-1 ml-2">
                <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
              </svg>
            </button>
          @else
            <button type="submit" title="お気に入り登録">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400 mt-1 ml-2">
                <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
              </svg>
            </button>
          @endif
      </form>
    </div>

    <form action="{{ route('seals.index') }}" method="GET" class="mb-5">
      {{-- 画像 --}}
      <div class="mx-auto mb-4" style="width: 50%; padding-top: 50%; position: relative;">
        <img src="{{ $seal->image }}" alt="{{ $seal->name }}" class="rounded border-2 border-yellow-300" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
      </div>
      {{-- パッケージ --}}
      <div class="flex justify-center">
        <button type="submit" name="package" value="{{ $seal->package_id }}" class="font-bold text-gray-500 hover:text-pink-300 mb-2 text-lg">{{ $seal->package->name }}</button>
      </div>
      {{-- タグ --}}
      <div class="w-8/12 mx-auto px-4 py-2 bg-white rounded-xl flex flex-wrap mb-10">
        <p class="text-gray-400 mr-3">タグ</p>
        @foreach ($seal['tags'] as $st)
        <div class="mr-3 hover:text-sky-300">
          <button type="submit" name="keyword" value="{{ $st['name'] }}">{{ '#' . $st['name'] }}</button>
        </div>
        @endforeach
      </div>
    </form>

    {{-- 編集画面リンク --}}
    <div class="w-2/12 lg:w-1/12 mx-auto text-center bg-sky-300 hover:bg-sky-400 rounded-lg py-2">
      <a href="{{ route('seals.edit', $seal) }}" class="text-lg font-bold text-white">編集</a>
    </div>
  </div>
</x-app-layout>