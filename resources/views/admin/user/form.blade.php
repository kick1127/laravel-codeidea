@extends('layouts.admin')

@section('title', $title)

@section('content')
    <section class="container">
        <div class="page-title">{{ $title }}</div>

        <div class="writeContents">
            <div class="wr-wrap line label200">
                <div class="wr-list">
                    <div class="wr-list-label">아이디</div>
                    <div class="wr-list-con">
                        {{ request()->user()->username }}
                    </div>
                </div>
                <div class="wr-list">
                    <div class="wr-list-label">이름</div>
                    <div class="wr-list-con">
                        {{ request()->user()->name }}
                    </div>
                </div>
                <div class="wr-list">
                    <div class="wr-list-label">이메일</div>
                    <div class="wr-list-con">
                        {{ request()->user()->email }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

