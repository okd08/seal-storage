<x-app-layout>
  {{-- ページタイトル --}}
  @section('title', 'パッケージ編集')
  {{-- パンくず --}}
  {{ Breadcrumbs::render('edit2') }}
  {{-- フラッシュメッセージを読み込み --}}
  @include('flash::message')

  <form action="{{ route('packages.update', $package) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="w-8/12 lg:w-4/12 mx-auto pt-20">
      {{-- パッケージ名入力 --}}
      <p class="mb-2">パッケージ名を入力</p>
      <input type="text" name="name" value="{{ $package->name }}" placeholder="パッケージ名" class="border-2 border-sky-200 p-2 mb-6 ml-2 w-9/12 rounded block">
      {{-- パッケージ更新ボタン --}}
      <div class="flex justify-center mb-10">
        <button type="submit" class="bg-pink-300 hover:bg-pink-400 text-white text-xl font-bold py-2 px-6 rounded-lg">更新</button>
      </div>
    </div>
  </form>

  {{-- パッケージ削除ボタン --}}
  <form action="{{ route('packages.destroy', $package) }}" method="POST" class="pb-20 text-center">
    @csrf
    @method('DELETE')
    <button id="delete2" type="submit" class="bg-red-500 hover:bg-red-700 text-sm text-white font-bold py-2 px-4 rounded-lg">パッケージを削除する</button>
  </form>
</x-app-layout>

{{-- js読み込み --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script> {{-- sortable --}}
<script src="/js/create.js"></script>

<script>
  var destroy2 = document.getElementById('delete2');

  destroy2.addEventListener('click', function(evt) {
      if (!confirm('パッケージを削除すると、そのパッケージに登録されているシールも削除されます。本当に削除しますか？')) {
          evt.preventDefault();
      }
  });
</script>