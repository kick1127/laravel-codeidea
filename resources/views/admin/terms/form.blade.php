@extends('layouts.admin')

@section('title', $title)

@php
    if(isset($data)){
        $action = route('admin.terms.update', $data->id);
        $path = $data->path;
        $title = $data->title;
        $content = $data->content;
    } else {
        $action = route('admin.terms.store');
        $path = old('path');
        $title = old('title');
        $content = old('content');
    }
@endphp

@section('content')
    <section class="container">
        <div class="page-title">{{ $title }}</div>

        <div class="writeContents">
            <form id="boardForm" action="{{ $action }}" method="post">
                @csrf
                @isset($data)
                    @method('PUT')
                @endif

                <div class="wr-wrap line label200">
                    <div class="wr-list">
                        <div class="wr-list-label">경로</div>
                        <div class="wr-list-con">
                            <input type="text" id="path" name="path" value="{{ $path }}" class="span" placeholder="경로">
                        </div>
                    </div>
                    <div class="wr-list">
                        <div class="wr-list-label">약관명</div>
                        <div class="wr-list-con">
                            <input type="text" id="title" name="title" value="{{ $title }}" class="span" placeholder="약관명">
                        </div>
                    </div>
                    <div class="wr-list">
                        <div class="wr-list-label flex-start">약관</div>
                        <div class="wr-list-con">
                            <textarea name="content" id="content" cols="30" rows="10" style="width: 100%; height: 500px;">{{ $content ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="btnSet">
                    <a href="#" class="btn submit">
                        @isset($data)
                            수정
                        @else
                            등록
                        @endisset
                    </a>
                    @isset($data)
                        <a href="#" class="btn red btnDelete">삭제</a>
                    @endisset
                    <a href="#" class="btn gray btnList">리스트</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('/js/jquery-ui/jquery-ui.theme.css') }}">

    <style>
        .container #postcode {
            width: 100px;
        }

        #item_count_per_page {
            width: 70px;
            text-align: center;
        }

        #sortable {
            margin: 3px;
            padding: 3px;
            width: 200px;
            border: 1px solid black;
        }

        #sortable li {
            border: 1px solid black;
            margin: 5px;
            padding: 3px;
            cursor: pointer;
            text-align: center;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('/se2/js/service/HuskyEZCreator.js') }}" charset="utf-8"></script>

    <script type="text/javascript">
        var oEditors = [];
        nhn.husky.EZCreator.createInIFrame({
            oAppRef: oEditors,
            elPlaceHolder: 'content',
            sSkinURI: '{{ asset('/se2/SmartEditor2Skin.html') }}',
            fCreator: 'createSEditor2',
        });

        $(function() {
            $('.submit').click(function() {
                oEditors.getById['content'].exec('UPDATE_CONTENTS_FIELD', []);

                $('#boardForm').submit();

                return false;
            });

            $('.btnList').click(function() {
                location.href = '{{ route('admin.terms.index') }}';

                return false;
            });

            @isset($data)
            $('.btnDelete').click(function() {
                if (confirm('삭제하시겠습니까?')) {
                    $('#boardForm').attr('action', '{{ route('admin.board.destroy', $data->id) }}');
                    $('[name="_method"]').val('DELETE');
                    $('#boardForm').submit();
                }
                return false;
            });
            @endisset
        });
    </script>
@endpush

