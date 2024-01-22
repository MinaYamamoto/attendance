@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/userlistworkshow.css') }}">
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
<div class="userwork">
    <form class="userwork-form" action="/userlist/worksearch" method="get">
        @csrf
            @foreach($users as $user)
            <p class="user__name">ユーザ名：{{$user->name}}</p>
            @endforeach
        <div class="userwork-header">
            <div class="search">
                <label>勤務月：</label>
                <button type="submit" class="search__last-month" name="last_month" value="last_month">前月</button>
                <input class="search__month" name="search_month" value="{{$search_month->format('Y-m')}}" readonly/>
                <input type="hidden" name="user_id" value="{{ $user_id }}" />
                <button type="submit" class="search__next-month" name="next_month" value="next_month">翌月</button>
            </div>
        </div>
        <div class="userwork__table">
            <table>
                <tr>
                    <th>勤務日</th>
                    <th>勤務開始</th>
                    <th>勤務終了</th>
                    <th>休憩時間</th>
                    <th>勤務時間</th>
                </tr>
                @foreach($works as $work)
                <tr>
                    <td>{{ $work->work_date }}</td>
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