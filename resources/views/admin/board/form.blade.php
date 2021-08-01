@extends('layouts.admin')

@section('title', $title)

@php
    if(isset($data)){
        $action = route('admin.board.update', $data->id);
        $name = $data->name;
        $tableName = $data->tableName;
        $itemCountPerPage = $data->itemCountPerPage;
        $category = $data->category;
    } else {
        $action = route('admin.board.store');
        $name = old('name');
        $tableName = old('table_name');
        $itemCountPerPage = old('item_count_per_page') ?: 10;
        $category = '';
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
                        <div class="wr-list-label">게시판 이름</div>
                        <div class="wr-list-con">
                            <input type="text" id="name" name="name" value="{{ $name }}" class="span" placeholder="게시판 이름">
                        </div>
                    </div>
                    <div class="wr-list">
                        <div class="wr-list-label">테이블 이름</div>
                        <div class="wr-list-con">
                            @isset($data)
                                {{ $tableName }}
                            @else
                                <input type="text" id="table_name" name="table_name" value="{{ $tableName }}" class="span" placeholder="테이블 이름">
                            @endisset
                        </div>
                    </div>
                    <div class="wr-list">
                        <div class="wr-list-label">페이지 당 컨텐츠 수</div>
                        <div class="wr-list-con">
                            <input type="number" id="item_count_per_page" name="item_count_per_page" value="{{ $itemCountPerPage }}" class="span" placeholder="수">
                        </div>
                    </div>
                    <div class="wr-list">
                        <div class="wr-list-label">카테고리</div>
                        <div class="wr-list-con">
                            <input type="hidden" id="category" name="category" value="{{ $category }}">
                            <label for="item"></label>
                            <input type="text" id="item" placeholder="카테고리">
                            <a href="#" class="btn blue btnAddCategory">추가</a>
                            <ul id="sortable"></ul>
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
    <script src="{{ asset('/js/jquery-ui/jquery-ui.js') }}"></script>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#sortable').sortable();
            $('#sortable').disableSelection();

            function addCategory(category) {
                $('#sortable').append('<li>' + String(category).trim() + '</li>');
            }

            if ($('#category').val()) {
                var category = $('#category').val().split('||');
                for (var i = 0; i < category.length; i++) {
                    addCategory(category[i]);
                }
            }

            $('.btnAddCategory').click(function() {
                addCategory($('#item').val());
                $('#item').val('').focus();

                return false;
            });

            $('.submit').click(function() {
                var category = [];

                $('#sortable > li').each(function() {
                    category.push($(this).text());
                });

                $('#category').val(category.join('||'));

                $('#boardForm').submit();

                return false;
            });

            $('.btnList').click(function() {
                location.href = '{{ route('admin.board.index') }}';

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

