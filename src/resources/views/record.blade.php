@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/record.css') }}">
@endsection

@section('header')
<nav class="header__nav">
    <ul class="header__nav-list">
        <li class="header__nav-item"><a href="/">ホーム</a></li>
        <li class="header__nav-item"><a href="/attendance">日付一覧</a></li>
        <form class="header__form" action="/logout" method="post">
            @csrf
            <li class="header__nav-item"><button type="submit" class="header__logout">ログアウト</button></li>
        </form>
    </ul>
</nav>
@endsection

@section('content')
<div class="record__content">
    <form class="record__header" action="/" method="GET">
        @csrf
        <div class="record__user-name">
            <!-- DBから名前を取得するように修正する -->
            <p>テスト　太郎さんお疲れ様です!</p>
        </div>
    </form>
    <!-- <form class="record__start" action="/recordstart" method="POST">
        <div class="work__start"><button class="work__start-submit" value="work__start" type="submit">勤務開始</button></div>
        <div class="break__start"><button class="break__start-submit" value="break__start" type="submit">休憩開始</button></div>
    </form>
    <form class="record__end" action="/recordend" method="POST">
        <div class="work__end"><button class="work__end-submit" value="work__end">勤務終了</button></div>
        <div class="break__end"><button class="break__end-submit" value="break__end">休憩終了</button></div>
    </form> -->
    <div class="record__button-box">
        <form class="work__start" action="/workstart" method="post">
            @csrf
            <button class="work__start-submit" type="submit">勤務開始</button>
        </form>
        <form class="work__end" action="/workend" method="post">
            @method('PATCH')
            @csrf
            <button class="work__end-submit" type="submit" disabled>勤務終了</button>
        </form>
        <form class="break__start" action="/breakstart" method="post">
            @csrf
            <button class="break__start-submit" type="submit">休憩開始</button>
        </form>
        <form class="break__end" action="/breakend" method="post" disabled>
            @method('PATCH')
            @csrf
            <button class="break__end-submit" type="submit" disabled>休憩終了</button>
        </form>
    </div>
</div>
@endsection
