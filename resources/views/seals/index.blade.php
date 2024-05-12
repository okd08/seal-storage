<x-app-layout>
  {{-- ページタイトル --}}
  @section('title', 'シール一覧')
  {{-- パンくず --}}
  {{ Breadcrumbs::render('index') }}
  {{-- フラッシュメッセージを読み込み --}}
  @include('flash::message')

  {{-- 検索 --}}
  <div class="my-8">
    <form action="{{ route('seals.index') }}" method="GET">
      <div class="flex flex-wrap justify-center mx-auto w-8/12 items-center">
        {{-- パッケージ選択 --}}
        <select name="package" class="border-2 border-sky-200 pr-8 py-2 px-2 mr-4 mb-2 rounded">
          <option value="" selected>パッケージを選択</option>
          @foreach ($packages as $p)
            <option value="{{ $p->id }}" {{ $selectedPackage == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
          @endforeach
        </select>
        {{-- キーワード入力 --}}
        <input type="text" name="keyword" value="{{ $keyword }}" class="border-2 border-pink-200 mr-4 mb-2 rounded" placeholder="タグまたはキーワードを入力">
        {{-- お気に入り --}}
        <div class="flex items-center mr-6 mb-2">
          <input type="checkbox" name="favorite" id="favorite" class="mr-1 rounded" {{ request('favorite') ? 'checked' : '' }}>
          <label for="favorite" class="text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 lg:w-8 lg:h-8 text-pink-400">
              <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
            </svg>
          </label>
        </div>
        {{-- 検索ボタン --}}
        <button type="submit" class="font-bold bg-yellow-300 text-gray-500 hover:bg-indigo-500 hover:text-white px-5 py-3 -mt-1 rounded">検索</button>
      </div>
    </form>
  </div>

  {{-- 一覧 --}}
  <div class="mx-4 pb-10">
    <div class="flex flex-wrap justify-center mb-4">
      {{-- シール --}}
      @forelse ($seals as $s)
        <div class="border-2 border-yellow-300 bg-white rounded-md mx-2 my-3 w-1/4 lg:w-1/5">
          <a href="{{ route('seals.show', $s) }}">
            {{-- 画像 --}}
            <div class="rounded overflow-hidden" style="width: 100%; padding-top: 100%; position: relative;">
              {{-- お気に入り --}}
              @if ($s->favorite == 0)
              <div class="absolute bottom-0 right-0 p-1 z-10">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 lg:w-10 lg:h-10 text-pink-400">
                  <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                </svg>
              </div>
              @endif
              <img src="{{ $s->image }}" alt="{{ $s->name }}" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
            </div>
          </a>
        </div>
      {{-- シールが無い場合 --}}
      @empty
      <p>登録されたシールがありません。</p>
      @endforelse
    </div>
    {{-- ページネーション --}}
    {{ $seals->links() }}
  </div>

  {{-- 上に戻るボタン --}}
  <button onclick="scrollToTop()"  class="fixed bottom-5 right-5 bg-sky-200 hover:bg-sky-300 text-pink-300 text-xl py-2 px-2 rounded-full z-20">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
    </svg>
  </button>

  {{-- JavaScript --}}
  <script src="/js/index.js"></script>
</x-app-layout>
