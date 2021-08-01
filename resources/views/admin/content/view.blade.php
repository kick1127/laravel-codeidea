@extends('layouts.admin')

@section('title', $title)

@section('content')
    <section class="container">
        <div class="page-title">{{ $title }}</div>

        <div class="writeContents">
            <div class="wr-wrap line label200">
                <div class="wr-wrap line label200">
                    <div class="wr-list">
                        <div class="wr-list-label">카테고리</div>
                        <div class="wr-list-con">
                            {{ $data->category }}
                        </div>
                    </div>

                    <div class="wr-list">
                        <div class="wr-list-label">상단 고정</div>
                        <div class="wr-list-con">
                            @if($data->top_fix)
                                고정
                            @else
                                -
                            @endif
                        </div>
                    </div>

                    <div class="wr-list">
                        <div class="wr-list-label">제목</div>
                        <div class="wr-list-con">
                            {{ $data->title }}
                        </div>
                    </div>

                    <div class="wr-list">
                        <div class="wr-list-label">작성자</div>
                        <div class="wr-list-con">
                            {{ $data->author }}
                        </div>
                    </div>

                    <div class="wr-list">
                        <div class="wr-list-label flex-start">내용</div>
                        <div class="wr-list-con se2_outputarea">
                            {!! $data->content !!}
                        </div>
                    </div>

                    <div class="wr-list">
                        <div class="wr-list-label flex-start">첨부파일</div>
                        <div class="wr-list-con">
                            <ul>
                                @foreach($data->files() as $file)
                                    <li>
                                        <a href="{{ route('admin.download', [base64_encode($file->originalName), base64_encode($file->filename), base64_encode($file->mimeType)]) }}" target="_blank">{{ $file->originalName }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="btnSet">
                    <a href="{{ route('admin.board.content.edit', [$board->tableName, $data->id]) }}" class="btn edit">수정</a>
                    <a href="#" class="btn gray btnList">리스트</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('/se2/css/ko_KR/smart_editor2_out.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('.btnList').click(function() {
                location.href = '{{ route('admin.board.content.index', $board->tableName) }}';

                return false;
            });
        });
    </script>
@endpush
