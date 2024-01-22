@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/userlist.css') }}">
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
<div class="userlist">
    <form class="userlist__form" action="/userlist" method="get">
        @csrf
        <div class="userlist__table">
            <table>
                <tr>
                    <th>ユーザID</th>
                    <th>名前</th>
                    <th></th>
                </tr>
                <tr>
                    @foreach($users as $user)
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td><a class="userlist__work" href="{{ route('userwork.search', ['user_id'=>$user->id]) }}">勤務表</a></td>
                </tr>
                    @endforeach
            </table>
        </div>
        <div class="form__paginate">
            {{ $users->links() }}
        </div>
    </form>
</div>
@endsection