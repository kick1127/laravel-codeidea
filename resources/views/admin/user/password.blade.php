@extends('layouts.admin')

@section('title', $title)

@section('content')
    <section id="write" class="container">
        <div class="page-title">{{ $title }}</div>

        <form id="passwordForm" action="{{ route('admin.update-password') }}" method="post">
            @csrf

            <div class="writeContents">
                <div class="wr-wrap line label200">
                    <div class="wr-list">
                        <div class="wr-list-label">기존 비밀번호</div>
                        <div class="wr-list-con">
                            <input type="password" id="password" name="password" value="" class="span" placeholder="기존 비밀번호">
                        </div>
                    </div>
                    <div class="wr-list">
                        <div class="wr-list-label">새 비밀번호</div>
                        <div class="wr-list-con">
                            <input type="password" id="new_password" name="new_password" value="" class="span" placeholder="새 비밀번호">
                        </div>
                    </div>
                    <div class="wr-list">
                        <div class="wr-list-label">새 비밀번호 확인</div>
                        <div class="wr-list-con">
                            <input type="password" id="new_password_confirm" name="new_password_confirm" value="" class="span" placeholder="새 비밀번호 확인">
                        </div>
                    </div>
                </div>

                <div class="btnSet">
                    <a href="#" class="btn submit">확인</a>
                </div>
            </div>
        </form>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('.submit').click(function() {
                $('#passwordForm').submit();
            });
        });
    </script>
@endpush

