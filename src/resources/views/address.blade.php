<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フリマアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/address.css') }}">
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
            <div class="container__ttl">住所の変更</div>
            <form class="upload-form" action="/purchase/address/{{$item_id}}/upload" method="post">
                @csrf
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

</body>

</html>
