@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
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
<div class="attendance__content">
    <div class="attendance-header">
        <h2>
            <!-- ページネーション未実装 -->
            2021-11-11
        </h2>
    </div>
    <form class="attendance-form" action="/attendance" method="get">
        @csrf
        <div class="form__attendance">
            <table>
                <tr>
                    <th>名前</th>
                    <th>勤務開始</th>
                    <th>勤務終了</th>
                    <th>休憩時間</th>
                    <th>勤務時間</th>
                </tr>
                <tr>
                    <td>テスト　太郎１</td>
                    <td>10:00:00</td>
                    <td>19:00:00</td>
                    <td>00:30:00</td>
                    <td>08:30:00</td>
                </tr>
                <tr>
                    <td>テスト　太郎１</td>
                    <td>10:00:00</td>
                    <td>19:00:00</td>
                    <td>00:30:00</td>
                    <td>08:30:00</td>
                </tr>
                <tr>
                    <td>テスト　太郎１</td>
                    <td>10:00:00</td>
                    <td>19:00:00</td>
                    <td>00:30:00</td>
                    <td>08:30:00</td>
                </tr>
                <tr>
                    <td>テスト　太郎１</td>
                    <td>10:00:00</td>
                    <td>19:00:00</td>
                    <td>00:30:00</td>
                    <td>08:30:00</td>
                </tr>
                <tr>
                    <td>テスト　太郎１</td>
                    <td>10:00:00</td>
                    <td>19:00:00</td>
                    <td>00:30:00</td>
                    <td>08:30:00</td>
                </tr>
            </table>
        </div>
        <div class="form__paginate">
            <p>1 2 3 4 5</p>
            <!-- ページネーション未実装 -->
        </div>
    </form>
</div>
@endsection
