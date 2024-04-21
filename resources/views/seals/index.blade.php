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
        <input type="text" name="keyword" value="{{ $keyword }}" class="border-2 border-pink-200 mr-6 mb-2 rounded" placeholder="タグまたはキーワードを入力">
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
            <div class="rounded overflow-hidden mb-1" style="width: 100%; padding-top: 100%; position: relative;">
              <img src="{{ $s->image }}" alt="{{ $s->name }}" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
            </div>
            {{-- テキスト --}}
            <div style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
              <h3 class="text-gray-500 text-xs">{{ $s->package->name }}</h3>
              <h2 class="text-gray-900 text-lg">{{ $s->name }}</h2>
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
  <button onclick="scrollToTop()"  class="fixed bottom-5 right-5 bg-sky-200 hover:bg-sky-300 text-pink-300 text-xl font-bold py-1 px-3 rounded-full z-20">↑</button>

  {{-- JavaScript --}}
  <script src="/js/index.js"></script>
</x-app-layout>
