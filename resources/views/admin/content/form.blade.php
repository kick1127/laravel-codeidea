@extends('layouts.admin')

@section('title', $title)

@php
    if(isset($data)){
        $action = route('admin.board.content.update', [$board->tableName, $data->id]);
        $top_fix = $data->top_fix;
        $boardTitle = $data->title;
        $author = $data->author;
        $content = $data->content;
        $category = $data->category;
    } else {
        $action = route('admin.board.content.store', $board->tableName);
        $top_fix = old('top_fix');
        $boardTitle = old('title');
        $author = old('author');
        $content = old('content');
        $category = '';
        $files = '';
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
                    <div class="wr-wrap line label200">
                        @if($board->category)
                            <div class="wr-list">
                                <div class="wr-list-label">카테고리</div>
                                <div class="wr-list-con">
                                    <select name="category" id="category">
                                        @foreach(explode('||', $board->category) as $item)
                                            <option value="{{ $item }}" @if($category == $item) selected @endif>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="wr-list">
                            <div class="wr-list-label">상단 고정</div>
                            <div class="wr-list-con">
                                <label class="toggle-light" data-on="고정" data-off="미고정">
                                    <input type="checkbox" id="top_fix" name="top_fix" value="1" @if($top_fix) checked @endif />
                                </label>
                            </div>
                        </div>

                        <div class="wr-list">
                            <div class="wr-list-label">제목</div>
                            <div class="wr-list-con">
                                <input type="text" id="title" name="title" value="{{ $boardTitle ?? '' }}" class="span" placeholder="제목">
                            </div>
                        </div>

                        <div class="wr-list">
                            <div class="wr-list-label">작성자</div>
                            <div class="wr-list-con">
                                <input type="text" id="author" name="author" value="{{ $author ?? '' }}" class="span" placeholder="작성자">
                            </div>
                        </div>

                        <div class="wr-list">
                            <div class="wr-list-label flex-start">내용</div>
                            <div class="wr-list-con">
                                <textarea name="content" id="content" cols="30" rows="10" style="width: 100%; height: 500px;">{{ $content ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="wr-list">
                            <div class="wr-list-label flex-start">첨부파일</div>
                            <div class="wr-list-con">
                                <a href="#" class="btn blue btnFileUpload">업로드</a>
                                <input type="hidden" id="files" name="files" value="{{ $files }}">
                                <ul class="file-list"></ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btnSet">
                    <a href="#" class="btn submit">
                        @isset($data)
                            저장
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

            <form id="formFile" action="{{ route('admin.file.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" id="file" name="file" class="default">
            </form>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        #formFile {
            display: none;
        }

        .file-list {
            margin: 5px;
        }

        .delete-file {
            cursor: pointer;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('/js/jquery.form.min.js') }}" charset="utf-8"></script>
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
            function addFile(index, file) {
                var html = '<li class="file-item">' + file.original_name + ' <i class="icon-cancel-squared delete-file" data-index="' + index + '"></i></li>';
                $('.file-list').append(html);
            }

            function deleteFile(index) {
                var files = JSON.parse($('#files').val());
                files.splice(index, 1);
                $('#files').val(JSON.stringify(files));
                showFiles(files);
            }

            function showFiles(data) {
                $('.file-list').empty();

                for (var i = 0; i < data.length; i++) {
                    addFile(i, data[i]);
                }
            }

            function loadFiles() {
                var files = [];
                if ($('#files').val()) {
                    files = JSON.parse($('#files').val());
                }
                showFiles(files);
            }

            loadFiles();

            $('#formFile').ajaxForm({
                beforeSubmit: function(arr, $form, options) {},
                success: function(data, statusText, xhr, $form) {
                    var files = [];

                    if ($('#files').val()) {
                        files = JSON.parse($('#files').val());
                    }

                    files.push(data);

                    $('#files').val(JSON.stringify(files));

                    showFiles(files);
                },
                error: function(error, type, message) {
                    alert('업로드 불가능한 파일입니다.');
                },
                dataType: 'json',
                type: 'post',
                clearForm: true,
                resetForm: true,
            });

            $('.file-list').on('click', '.delete-file', function() {
                deleteFile($(this).data('index'));
            });

            $('.btnFileUpload').click(function() {
                $('#file').click();

                return false;
            });

            $('#file').change(function() {
                $('#formFile').submit();
            });

            $('.submit').click(function() {
                oEditors.getById['content'].exec('UPDATE_CONTENTS_FIELD', []);

                $('#boardForm').submit();

                return false;
            });

            $('.btnList').click(function() {
                location.href = '{{ route('admin.board.content.index', $board->tableName) }}';

                return false;
            });

            @isset($data)
            $('.btnDelete').click(function() {
                if (confirm('삭제하시겠습니까?')) {
                    $('#boardForm').attr('action', '{{ route('admin.board.content.destroy', [$board->tableName, $data->id]) }}');
                    $('[name="_method"]').val('DELETE');
                    $('#boardForm').submit();
                }
                return false;
            });
            @endisset
        });
    </script>
@endpush

