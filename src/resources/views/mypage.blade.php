<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フリマアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
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
                            <button class="header-nav__button">ログアウト</button>
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
            <div class="container-top__profile">
                <div class="container-top__profile-img">
                    @isset($user->profile_image)
                        <img src="{{ asset($user->profile_image) }}">
                    @endisset
                    @empty($user->profile_image)
                        <img alt="未設定" onerror="this.style.display='none'">
                    @endempty
                </div>
                <div class="container-top__profile-name">
                    {{ $user->user_name }}
                </div>
                <div class="container-top__profile-nav">
                    <a href="/mypage/profile">プロフィールを編集</a>
                </div>
            </div>
            <nav class="container-nav">
                <ul class="container-nav__list">
                    <li class="container-nav__item"><a href="/mypage?tab=sell" @class(['red' => $isSellItem])>出品した商品</a></li>
                    <li class="container-nav__item"><a href="/mypage?tab=buy" @class(['red' => $isBuyItem])>購入した商品</a></li>
                </ul>
            </nav>
            <div class="container__list">
                @foreach ($items as $item)
                    <a class="container__item" href="/item/{{$item->id}}">
                        <div class="container__item-img">
                            <img src="{{ asset($item->item_image) }}" alt="">
                        </div>
                        <p class="container__item-name">{{ $item->item_name }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </main>
</body>
</html>