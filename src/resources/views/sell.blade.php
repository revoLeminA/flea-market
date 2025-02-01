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
                            <input type="checkbox" name="categories[]" id="{{ 'checkbox' . $category->id }}" value="{{ $category->id }}"><label for="{{ 'checkbox' . $category->id }}">{{ $category->category_name }}</label>
                        @endforeach
                    </div>
                    <div class="form-item__error">
                        @error('category')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-item__ttl" for="brand_name">ブランド名</label>
                    <div class="form-item__select">
                        <span>選択肢を選んでください</span>
                        <div class="form-item__options">
                            <label class="form-item__option"><input type="radio" name="brand_name" value="1">Panasonic</label>
                            <label class="form-item__option"><input type="radio" name="brand_name" value="2">Shiseido</label>
                            <label class="form-item__option"><input type="radio" name="brand_name" value="3">Elecom</label>
                            <label class="form-item__option"><input type="radio" name="brand_name" value="4">JA</label>
                            <label class="form-item__option"><input type="radio" name="brand_name" value="5">Rolex</label>
                            <label class="form-item__option"><input type="radio" name="brand_name" value="6">COACH</label>
                            <label class="form-item__option"><input type="radio" name="brand_name" value="7">THERMOS</label>
                            <label class="form-item__option"><input type="radio" name="brand_names" value="8">Apple</label>
                            <label class="form-item__option"><input type="radio" name="brand_name" value="9">Anker</label>
                            <label class="form-item__option"><input type="radio" name="brand_name" value="10">DeLonghi</label>
                        </div>
                    </div>
                    <div class="form-item__error">
                        @error('brand_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-item__ttl" for="status">商品の状態</label>
                    <div class="form-item__select">
                        <span>選択肢を選んでください</span>
                        <div class="form-item__options">
                            <label class="form-item__option"><input type="radio" name="status" value="1">良好</label>
                            <label class="form-item__option"><input type="radio" name="status" value="2">目立った傷や汚れなし</label>
                            <label class="form-item__option"><input type="radio" name="status" value="3">やや傷や汚れあり</label>
                            <label class="form-item__option"><input type="radio" name="status" value="4">状態が悪い</label>
                        </div>
                    </div>
                    <div class="form-item__error">
                        @error('status')
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
                    <div class="yen-mark">
                        <input type="text" class="form-item__input" name="price" value="{{ old('price') }}">
                    </div>
                    <div class="form-item__error">
                        @error('price')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__btn">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <button class="form__btn-submit" type="submit">出品する</button>
                </div>
            </form>
        </div>
    </main>

<script>
    /*========================================
    画像のプレビュー表示
    ========================================*/
    // <input>でファイルが選択されたときの処理
    const fileInput = document.getElementById('item_img');
    // ファイル選択時に呼び出す関数
    fileInput.addEventListener('change', () => {
        const files = fileInput.files;
        if (0 < files.length) {
            previewFile(files[0]);
        }
    });
    // ファイル選択時にプレビュー画像を表示する処理
    function previewFile(file) {
        // プレビュー画像を追加する要素
        const preview = document.getElementById('preview');
        // プレビュー画像がすでにある場合は削除（innerHTMLを使わない）
        const existingImg = preview.querySelector('img');
        if (existingImg) {
            existingImg.remove();
        }
        // FileReaderオブジェクトを作成
        const reader = new FileReader();
        // ファイルが読み込まれたときに実行する
        reader.onload = function (e) {
            const imageUrl = e.target.result; // 画像のURLはevent.target.resultで呼び出せる
            const img = document.createElement("img"); // img要素を作成
            img.src = imageUrl; // 画像のURLをimg要素にセット
            preview.appendChild(img); // #previewの中に追加
            // preview.style.border = 'none'; // 画像が表示されたらborderを消す
            // 画像をクリックすると再度ファイル選択ダイアログを開く
            img.addEventListener('click', () => {
                fileInput.click();
            });
        }
        // いざファイルを読み込む
        reader.readAsDataURL(file);
    }

    /*========================================
    セレクトボックスの開閉動作
    ========================================*/
    const select = document.querySelector('.form-item__select');
    const dropdown = select.querySelector('.form-item__options');
    const options = dropdown.querySelectorAll('.form-item__option');
    const displaySpan = select.querySelector('span');
    // セレクトボックスの開閉
    select.addEventListener('click', () => {
        select.classList.toggle('open');
    });
    // オプション選択時の処理
    options.forEach(option => {
        const input = option.querySelector('input');
        option.addEventListener('click', (e) => {
            e.stopPropagation(); // クリックイベントが親要素に伝播しないようにする
            // 選択された値を表示
            displaySpan.textContent = option.textContent.trim();
            // 選択された値を取得
            console.log(`選択された値: ${input.value}`);
            // ドロップダウンを閉じる
            select.classList.remove('open');
        });
    });
    // ページ外クリックでドロップダウンを閉じる
    document.addEventListener('click', (e) => {
        if (!select.contains(e.target)) {
            select.classList.remove('open');
        }
    });
</script>

</body>
</html>

