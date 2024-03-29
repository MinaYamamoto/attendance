@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
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
<div class="attendance__content">
    <form class="attendance-form" action="/attendance/search" method="get">
        @csrf
        <div class="attendance__day">
            <div class="attendance__inner">
                <button name="sub_day" type="submit" value="sub_day">◀</button>
                <input name="search_day" value="{{$search_date->format('Y-m-d')}}" readonly/>
                <button name="add_day" type="submit" value="add_day">▶</button>
            </div>
        </div>
    </form>
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
                @foreach($works as $work)
                <tr>
                    <td>{{ $work->user->name }}</td>
                    <td>{{ $work->start_time }}</td>
                    <td>{{ $work->end_time }}</td>
                    <td>{{ $work->getRestTime() }}</td>
                    <td>{{ $work->getWorkTime() }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="form__paginate">
            {{ $works->appends(request()->input())->links() }}
        </div>
    </form>
</div>
@endsection
