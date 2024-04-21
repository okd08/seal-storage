<x-app-layout>
  {{-- ページタイトル --}}
  @section('title', 'パッケージ、シール編集')
  {{-- パンくず --}}
  {{ Breadcrumbs::render('edit') }}
  {{-- フラッシュメッセージを読み込み --}}
  @include('flash::message')

  {{-- パッケージ編集 --}}
  <form action="{{ route('seals.store') }}" method="POST">
    @csrf
    <div class="w-10/12 pt-20 mx-auto">
      <p class="text-bold text-lg mb-4 font-bold text-center">┈୨୧┈ パッケージ編集 ┈୨୧┈</p>
      <div class="w-6/12 lg:w-3/12 mx-auto text-center bg-sky-300 hover:bg-sky-400 rounded-lg py-2">
        <a href="{{ route('packages.index') }}" class="text-lg font-bold text-white">パッケージ管理画面へ</a>
      </div>
    </div>
  </form>

  {{-- シール編集 --}}
  <form action="{{ route('seals.update', $seal) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="w-10/12 lg:w-8/12 pt-20 mx-auto">
      <p class="text-bold text-lg mb-4 font-bold text-center">┈୨୧┈ シール編集 ┈୨୧┈</p>
      <div class="border-2 border-gray-200 p-4 items-center mb-3">
        <div class="grid grid-cols-2 gap-6">
          {{-- 画像選択 --}}
          <div class="col-span-1">
            <div style="width: 100%; padding-top: 100%; position: relative;">
              <img id="preview" src="{{ $seal->image }}" alt="シールの画像" class="object-cover w-full rounded border-2 border-yellow-300" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
            </div>
            <input id="image" type="file" name="image" class="bg-white p-2 w-full border-2 border-yellow-300 rounded">
          </div>
          <div class="col-span-1">
            {{-- パッケージ選択 --}}
            <p>パッケージを選択</p>
            <select name="package" class="border-2 border-sky-200 py-2 ml-2 mb-6 pr-10 rounded">
              <option value="" disabled>選択してください</option>
              @foreach ($packages as $p)
                <option value="{{ $p->id }}" {{ ($seal['package_id'] ?? null) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
              @endforeach
            </select>
            {{-- シール名入力 --}}
            <p>シール名を入力</p>
            <input type="text" name="name" value="{{ $seal->name }}" placeholder="シール名" class="border-2 border-sky-200 p-2 mb-6 ml-2 w-9/12 rounded block">
            {{-- タグ名入力 --}}
            <p>タグを入力</p>
            <div id="tags">
              @foreach ($seal->tags as $i => $ot)
                <div class="tag flex items-center">
                  <span class="mx-2 -mt-2">・</span>
                  <input type="text" name="tags[{{ $i }}][name]" value="{{ $ot['name'] }}" placeholder="タグ名" class="border-2 border-pink-200 p-2 mb-3 w-7/12 rounded block">
                  {{-- タグ削除ボタン --}}
                  <p class="text-sky-300 hover:text-sky-500 text-3xl hover:cursor-pointer -mt-4 ml-2 tag-delete">×</p>
                </div>
              @endforeach
            </div>
            {{-- タグ追加ボタン --}}
            <div class="flex justify-center">
              <button type="button" id="tag-add" class="bg-yellow-300 hover:bg-yellow-400 text-white text-lg font-bold py-2 px-4 rounded-full">+</button>
            </div>
          </div>
        </div>
      </div>
      {{-- シール更新ボタン --}}
      <div class="flex justify-center mb-10">
        <button type="submit" class="bg-pink-300 hover:bg-pink-400 text-white text-xl font-bold py-2 px-6 rounded-lg">更新</button>
      </div>
    </div>
  </form>

  {{-- シール削除ボタン --}}
  <form action="{{ route('seals.destroy', $seal) }}" method="POST" class="pb-20 text-center">
    @csrf
    @method('DELETE')
    <button id="delete" type="submit" class="bg-red-500 hover:bg-red-700 text-sm text-white font-bold py-2 px-4 rounded-lg">シールを削除する</button>
  </form>
</x-app-layout>

{{-- js読み込み --}}
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script> {{-- sortable --}}
  <script src="/js/create.js"></script>