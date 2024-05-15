<x-app-layout>
  {{-- ページタイトル --}}
  @section('title', 'パッケージ、シール登録')
  {{-- パンくず --}}
  {{ Breadcrumbs::render('create') }}
  {{-- フラッシュメッセージを読み込み --}}
  @include('flash::message')

  {{-- パッケージ登録 --}}
  <form action="{{ route('seals.store') }}" method="POST">
    @csrf
    <div class="w-10/12 pt-20 mx-auto">
      <p class="text-bold text-lg mb-4 font-bold text-center text-gray-700">┈୨୧┈ パッケージ登録 ┈୨୧┈</p>
      <div class="text-center">
        <input type="text" name="name" value="{{ old('name') }}" placeholder="パッケージ名" class="border-2 border-indigo-500 w-6/12 lg:w-4/12 p-2 mb-6 rounded">
        <button type="submit" class="bg-yellow-300 hover:bg-yellow-400 text-white text-lg font-bold py-2 px-3 rounded-lg ml-2">登録</button>
        <div class="w-6/12 lg:w-3/12 mx-auto text-center bg-sky-300 hover:bg-sky-400 rounded-lg py-2">
          <a href="{{ route('packages.index') }}" class="text-lg font-bold text-white">パッケージ管理画面へ</a>
        </div>
      </div>
    </div>
  </form>

  {{-- シール登録 --}}
  <form action="{{ route('seals.store2') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="w-10/12 lg:w-8/12 py-20 mx-auto">
      <p class="text-bold text-lg mb-4 font-bold text-center text-gray-700">┈୨୧┈ シール登録 ┈୨୧┈</p>
      <div class="border-2 border-gray-200 p-4 items-center mb-3">
        <div class="grid grid-cols-2 gap-6">
          {{-- 画像選択 --}}
          <div class="col-span-1">
            <div style="width: 100%; padding-top: 100%; position: relative;">
              <img id="preview" src="/images/dummy.png" alt="シールの画像" class="object-cover w-full rounded border-2 border-yellow-300" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
            </div>
            <input id="image" type="file" name="image" class="bg-white p-2 w-full border-2 border-yellow-300 rounded">
          </div>
          <div class="col-span-1">
            {{-- パッケージ選択 --}}
            <p>パッケージを選択</p>
            <select name="package_id" class="border-2 border-sky-200 py-2 ml-2 mb-6 pr-10 rounded">
              <option value="" disabled>選択してください</option>
              @foreach ($packages as $p)
                <option value="{{ $p->id }}" {{ (old('package') ?? null) == $p['id'] ? 'selected' : '' }}>{{ $p->name }}</option>
              @endforeach
            </select>
            {{-- シール名入力 --}}
            <p>シール名を入力</p>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="シール名" class="border-2 border-sky-200 p-2 mb-6 ml-2 w-9/12 rounded block">
            {{-- タグ名入力 --}}
            <p>タグを入力</p>
            <div id="tags">
              @php
                $old_tags = old('tags') ?? null;
              @endphp
              @if (is_null($old_tags))
                @for ($i = 0; $i < 1; $i++)
                  <div class="tag flex items-center">
                    <span class="mx-2 -mt-2">・</span>
                    <input type="text" name="tags[{{ $i }}][name]" placeholder="タグ名" class="border-2 border-pink-200 p-2 mb-3 w-7/12 rounded block">
                    {{-- タグ削除ボタン --}}
                    <p class="text-sky-300 hover:text-sky-500 text-3xl hover:cursor-pointer -mt-4 ml-2 tag-delete">×</p>
                  </div>
                @endfor
              @else
                @foreach ($old_tags as $i => $ot)
                  <div class="tag flex items-center">
                    <span class="mx-2 -mt-2">・</span>
                    <input type="text" name="tags[{{ $i }}][name]" value="{{ $ot['name'] }}" placeholder="タグ名" class="border-2 border-pink-200 p-2 mb-3 w-7/12 rounded block">
                    {{-- タグ削除ボタン --}}
                    <p class="text-sky-300 hover:text-sky-500 text-3xl hover:cursor-pointer -mt-4 ml-2 tag-delete">×</p>
                  </div>
                @endforeach
              @endif
            </div>
            {{-- タグ追加ボタン --}}
            <div class="flex justify-center">
              <button type="button" id="tag-add" class="bg-yellow-300 hover:bg-yellow-400 text-white text-lg font-bold py-2 px-4 rounded-full">+</button>
            </div>
          </div>
        </div>
      </div>
      {{-- シール登録ボタン --}}
      <div class="flex justify-center">
        <button type="submit" class="bg-pink-300 hover:bg-pink-400 text-white text-xl font-bold py-2 px-6 rounded-lg">登録</button>
      </div>
    </div>
  </form>
</x-app-layout>

{{-- js読み込み --}}
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script> 
  <script src="/js/create.js"></script>