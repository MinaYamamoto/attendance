@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="card">
        <p class="card__message">
            {{ __('ご登録いただいたメールアドレスに確認用のリンクをお送りしました。') }}
        </p>
        <p class="card__message">
            {{ __('届いたメールをご確認の上、記載のリンクから登録を完了させてください。') }}

        </p>
        <p class="retransmission__message">
            {{ __('もし確認用メールが送信されていない場合は、下記をクリックしてください。') }}
        </p>
        <form class="retransmission" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="retransmission-button">{{ __('確認メールを再送信する') }}</button>
        </form>
    </div>
</div>
@endsection