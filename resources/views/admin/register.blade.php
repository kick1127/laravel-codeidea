@extends('layouts.base')

@section('title', 'Login')

@section('base-head')
    <meta charset="utf-8">
    <meta http-equiv="imagetoolbar" content="no">
    <meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1">
    <link rel="shortcut icon" href="{{ asset('cozyfex/img/favorite/favorite.ico') }}" />
@endsection

@push('base-styles')
    <link rel="stylesheet" href="{{ asset('cozyfex/css/root.css') }}">
    <link rel="stylesheet" href="{{ asset('cozyfex/js/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('cozyfex/js/form/myform.css') }}">
    <link rel="stylesheet" href="{{ asset('cozyfex/css/styleDefault.css') }}">
    <link rel="stylesheet" href="{{ asset('cozyfex/css/style.css') }}">
@endpush

@push('base-scripts')
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="{{ asset('cozyfex/js/magnific-popup/jquery.magnific-popup.js') }}"></script>
    <script type="text/javascript" src="{{ asset('cozyfex/js/form/myform.js') }}"></script>
    <script type="text/javascript" src="{{ asset('cozyfex/js/myScript.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('.register').click(function() {
                $('#registerForm').submit();
            });
        });
    </script>
@endpush

@section('base-content')
    <section id="section-login">
        <div class="visual"><img src="{{ asset('cozyfex/img/login-img.png') }}">
        </div>

        <div class="login-wrap">
            <form id="registerForm" name="registerForm" action="{{ route('admin.register') }}" method="post">
                @csrf

                <div class="title">관리자 등록<br />
                    <span class="sub"></span>
                </div>
                <input type="text" name="username" id="username" required autofocus class="large span" placeholder="아이디">
                <input type="password" name="password" id="password" required class="large span" placeholder="비밀번호">
                <input type="password" name="password_confirmation" id="password_confirmation" required class="large span" placeholder="비밀번호 확인">
                <input type="text" name="name" id="name" required class="large span" placeholder="이름">
                <input type="text" name="email" id="email" required class="large span" placeholder="이메일">

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <div class="tcenter">
                    <a href="#" class="btn register">등록</a>
                </div>
            </form>
        </div>

    </section>
@endsection
