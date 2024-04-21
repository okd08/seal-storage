// htmlが読み込まれてから実行
window.onload = function () {

    // 画像のプレビュー
    var preview = document.getElementById('preview');
    var image = document.getElementById('image');

    image.addEventListener('change', function(evt) {
        var file = evt.target.files[0];
        if(file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // タグ削除
    var tags = document.getElementById("tags");

    tags.addEventListener("click", function (evt) {
        if (
            evt.target.classList.contains("tag-delete") ||
            evt.target.closest(".tag-delete")
        ) {
            evt.target.closest(".tag").remove();
            var items = tags.querySelectorAll(".tag");
        }
    });

    // タグ追加
    var addTag = document.getElementById("tag-add");
    addTag.addEventListener("click", function () {
        var tagCount = tags.querySelectorAll(".tag").length;
        var tag = document.createElement("div");
        tag.classList.add("tag");
        tag.classList.add("flex");
        tag.classList.add("items-center");

        tag.innerHTML = `
            <span class="mx-2 -mt-2">・</span>
            <input type="text" name="tags[{{ $i }}][name]" placeholder="タグ名" class="border-2 border-pink-200 p-2 mb-3 w-7/12 rounded block">
            <p class="text-sky-300 hover:text-sky-500 text-3xl hover:cursor-pointer -mt-4 ml-2 tag-delete">×</p>
        `;

        tags.appendChild(tag);
    });

    // 削除アラート
    var destroy = document.getElementById('delete');

    destroy.addEventListener('click', function(evt) {
        if (!confirm('本当に削除しますか？')) {
            evt.preventDefault();
        }
    });
};