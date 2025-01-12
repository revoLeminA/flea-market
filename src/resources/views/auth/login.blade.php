<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フリマアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <header>
        <div class="header-inner">
            <div class="header__ttl">
                <img src="{{ asset('images/logo.svg') }}" alt="">
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="container__ttl">ログイン</div>
            <form class="login-form" action="/login" method="post">
                @csrf
                <div class="form-item">
                    <label class="form-item__ttl" for="email">メールアドレス</label>
                    <input type="text" class="form-item__input" name="email" value="{{ old('email') }}">
                    <div class="form-item__error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-item__ttl" for="password">パスワード</label>
                    <input type="password" class="form-item__input" name="password" value="{{ old('password') }}">
                    <div class="form-item__error">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__btn">
                    <button class="form__btn-submit" type="submit">ログインする</button>
                </div>
            </form>
            <div class="auth-nav">
                <a href="/register">会員登録はこちら</a>
            </div>
        </div>
    </main>
</body>
</html>