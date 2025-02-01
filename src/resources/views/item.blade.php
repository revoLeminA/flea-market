<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フリマアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/item.css') }}">
</head>

<body>
    <header>
        <div class="header-inner">
            <div class="header__ttl">
                <img src="{{ asset('images/logo.svg') }}" alt="">
            </div>
            <form action="/search" class="search-form" method="get">
                @csrf
                <input type="search" class="search-form__input" name="keyword" placeholder="なにをお探しですか？">
            </form>
            <nav class="header-nav">
                <ul class="header-nav__list">
                    <li class="header-nav__item">
                        <form class="form" action="/logout" method="post">
                            @csrf
                            <button class="header-nav__btn">ログアウト</button>
                        </form>
                    </li>
                    <li class="header-nav__item"><a href="/mypage?tab=sell">マイページ</a></li>
                    <li class="header-nav__item reversible"><a href="/sell">出品</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="container-left">
                <div class="item-img">
                    <img src="{{ asset($item->item_image) }}" >
                </div>
            </div>
            <div class="container-right">
                <div class="item-name">{{ $item->item_name }}</div>
                <div class="brand-name">{{ $item->brand_name }}</div>
                <div class="price">￥{{ $item->item_name }}（税込み）</div>
                <div class="like-comment">
                    <div class="like"></div>
                    <div class="comment"></div>
                </div>
                <div class="nav-purchase">
                    <a href="/purchase/{{$item->id}}"></a>
                </div>
                <div class="description">
                    <lable class="description-ttl">商品説明</lable>
                    {{ $item->description }}
                </div>
                <div class="item-data">
                    <div class="item-data__category"></div>
                    <div class="item-data__status"></div>
                </div>
                <div class="comment"></div>
            </div>
        </div>
    </main>

<script>
    // ファイル選択時にプレビュー画像を表示する処理
    function previewFile(file) {
        // プレビュー画像を追加する要素
        const preview = document.getElementById('preview');
        // プレビュー要素をクリア
        preview.innerHTML = "";

        // FileReaderオブジェクトを作成
        const reader = new FileReader();

        // ファイルが読み込まれたときに実行する
        reader.onload = function (e) {
            const imageUrl = e.target.result; // 画像のURLはevent.target.resultで呼び出せる
            const img = document.createElement("img"); // img要素を作成
            img.src = imageUrl; // 画像のURLをimg要素にセット
            preview.appendChild(img); // #previewの中に追加
        }

        // いざファイルを読み込む
        reader.readAsDataURL(file);
    }

    // <input>でファイルが選択されたときの処理
    const fileInput = document.getElementById('item_img');
    // changeイベントで呼び出す関数
    const handleFileSelect = () => {
        const files = fileInput.files;
        for (let i = 0; i < files.length; i++) {
            previewFile(files[i]); // 1つ1つのファイルデータはfiles[i]で取得できる
        }
    }

    // ファイル選択時にhandleFileSelectを発火
    fileInput.addEventListener('change', handleFileSelect);
</script>

</body>
</html>