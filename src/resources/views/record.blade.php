@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/record.css') }}">
@endsection

@section('header')
<nav class="header__nav">
    <ul class="header__nav-list">
        <li class="header__nav-item"><a href="/">ホーム</a></li>
        <li class="header__nav-item"><a href="/attendance">日付一覧</a></li>
        <li class="header__nav-item"><a href="/userlist">ユーザ一覧</a></li>
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
            <p>{{ $message }}</p>
        </div>
    </form>
    <div class="record__button-box">
        <form class="work__start" action="/workstart" method="post">
            @csrf
            @if($leaving_work_count == 1)
            <input class="work__start-submit" type="submit" name="work__start" id="work__start" value="勤務開始" disabled>
            @elseif($work_count == 0)
            <input class="work__start-submit" type="submit" name="work__start" id="work__start" value="勤務開始">
            @else
            <input class="work__start-submit" type="submit" name="work__start" id="work__start" value="勤務開始" disabled>
            @endif
        </form>
        <form class="work__end" action="/workend" method="post">
            @method('PATCH')
            @csrf
            @if($work_count == 1 && $rest_count > 0)
            <input class="work__end-submit" type="submit" name="work__end" id="work__end" value="勤務終了" disabled>
            @elseif($work_count == 0)
            <input class="work__end-submit" type="submit" name="work__end" id="work__end" value="勤務終了" disabled>
            @else
            <input class="work__end-submit" type="submit" name="work__end" id="work__end" value="勤務終了" >
            @endif
        </form>
        <form class="rest__start" action="/reststart" method="post">
            @csrf
            @if($work_count > 0 && $rest_count == 0)
            <input class="rest__start-submit" type="submit" name="rest__start" id="rest__start" value="休憩開始">
            @else
            <input class="rest__start-submit" type="submit" name="rest__start" id="rest__start" value="休憩開始"disabled>
            @endif
        </form>
        <form class="rest__end" action="/restend" method="post">
            @method('PATCH')
            @csrf
            @if($rest_count == 0)
            <input class="rest__end-submit" type="submit" name="rest__end" id="rest__end" value="休憩終了" disabled>
            @else
            <input class="rest__end-submit" type="submit" name="rest__end" id="rest__end" value="休憩終了">
            @endif
        </form>
    </div>
</div>
@endsection
