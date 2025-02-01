<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フリマアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
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
            <div class="container__ttl">プロフィール設定</div>
            <form class="upload-form" action="/mypage/profile/upload" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-item">
                    <div class="form-item__left" id="preview"></div>
                    <div class="form-item__right">
                        <label for="profile_img" class="form-item__label">
                            画像を選択する
                            <input type="file" id="profile_img" class="form-item__input" name="profile_image">
                        </label>
                        <div class="form-item__error">
                            @error('profile_image')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-item__ttl" for="user_name">ユーザ名</label>
                    <input type="text" class="form-item__input" name="user_name" value="{{ $user->user_name }}">
                    <div class="form-item__error">
                        @error('user_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-item__ttl" for="postal_code">郵便番号</label>
                    <input type="text" class="form-item__input" name="postal_code" value="{{ $user->postal_code }}">
                    <div class="form-item__error">
                        @error('postal_code')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-item__ttl" for="address">住所</label>
                    <input type="text" class="form-item__input" name="address" value="{{ $user->address }}">
                    <div class="form-item__error">
                        @error('address')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-item__ttl" for="building">建物名</label>
                    <input type="text" class="form-item__input" name="building" value="{{ $user->building }}">
                </div>
                <div class="form__btn">
                    <button class="form__btn-submit" type="submit">更新する</button>
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

    // ファイル未選択時にDBに登録されているプレビュー画像を表示する処理
    function displayDefaultImage() {
        const preview = document.getElementById('preview');
        // プレビュー要素をクリア
        preview.innerHTML = "";

        const img = document.createElement("img");
        img.src = "{{ asset($user->profile_image) }}"; // デフォルトの画像URL
        preview.appendChild(img);
    }

    // <input>でファイルが選択されたときの処理
    const fileInput = document.getElementById('profile_img');
    // ファイル選択時に呼び出す関数
    fileInput.addEventListener('change', () => {
        const files = fileInput.files;
        if (0 < files.length) {
            previewFile(files[files.length-1]); // 1つ1つのファイルデータはfiles[i]で取得できる
        }
    });

    // 初期表示としてデフォルト画像を表示
    @isset($user->profile_image)
        document.addEventListener('DOMContentLoaded', displayDefaultImage);
    @endisset
</script>

</body>
</html>