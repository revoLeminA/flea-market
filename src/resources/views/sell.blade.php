<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フリマアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
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
            <div class="container__ttl">商品の出品</div>
            <form class="create-form" action="/sell/create" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-item">
                    <label class="form-item__ttl" for="item_img">商品画像</label>
                    <div class="form-item__img" id="preview">
                        <label for="item_img" class="form-item__label">
                            画像を選択する
                            <input type="file" id="item_img" class="form-item__input" name="item_image">
                        </label>
                        <div class="form-item__error">
                            @error('item_image')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__sub-ttl">
                    商品の詳細
                </div>
                <div class="form-item">
                    <label class="form-item__ttl" for="category">カテゴリー</label>
                    <div class="form-item__checkbox">
                        @foreach ($categories as $category)
                            <input type="checkbox" name="categories[]" id="{{ 'checkbox' . $category->id }}"><label for="{{ 'checkbox' . $category->id }}">{{ $category->category_name }}</label>
                        @endforeach
                    </div>
                    <div class="form-item__error">
                        @error('item_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-item__ttl" for="item_name">商品の状態</label>
                    <div class="form-item__select-wrapper">
                        <select type="text" class="form-item__input" name="status" value="{{ old('status') }}">
                            <option value="" selected hidden>選択してください</option>
                            <option value="1">良好</option>
                            <option value="2">目立った傷や汚れなし</option>
                            <option value="3">やや傷や汚れあり</option>
                            <option value="4">状態が悪い</option>
                        </select>
                    </div>
                    <div class="form-item__error">
                        @error('item_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__sub-ttl">
                    商品名と説明
                </div>
                <div class="form-item">
                    <label class="form-item__ttl" for="item_name">商品名</label>
                    <input type="text" class="form-item__input" name="item_name" value="{{ old('item_name') }}">
                    <div class="form-item__error">
                        @error('item_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-item__ttl" for="description">商品説明</label>
                    <textarea class="form-item__input" name="description" value="{{ old('description') }}"></textarea>
                    <div class="form-item__error">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-item__ttl" for="price">販売価格</label>
                    <input type="text" class="form-item__input" name="price" value="{{ old('price') }}" placeholder="￥">
                    <div class="form-item__error">
                        @error('price')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__btn">
                    <button class="form__btn-submit" type="submit">出品する</button>
                </div>
            </form>
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