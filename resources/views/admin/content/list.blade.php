@extends('layouts.admin')

@section('title', $title)

@section('content')
    <section class="container">
        <div class="page-title">{{ $title }}</div>

        <form id="searchForm" action="" method="get">
            <input type="hidden" id="search" name="search" value="{{ $search }}">

            <div class="data-search-wrap">
                <div class="data-sel">
                    @if($board->category)
                        <select id="category" name="category" data-style="selectColor-black">
                            <option value="" data-subtext="(선택)">카테고리</option>
                            @foreach(explode('||', $board->category) as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    @endif
                    <select id="search_type" name="search_type">
                        <option value="">검색항목</option>
                        <option value="title">제목</option>
                        <option value="author">이름</option>
                    </select>
                    <input type="text" id="search_keyword" name="search_keyword" value="" class="span250" placeholder="검색어">
                    <a href="#" class="btn gray btnSearch">검색</a>
                </div>
            </div>
        </form>

        <div class="tbl-basic cell td-h4 mt10">
            <div class="tbl-header">
                <div class="caption">총 <b>{{ $data->total() }}</b>개 글이 있습니다</div>
                <!--
                <div class="rightSet">
                    <a href="#" class="btn green small icon-excel">엑셀 다운로드</a>
                </div>
                -->
            </div>
            <table>
                <colgroup>
                    <col width="50">
                    @if($board->category)
                        <col width="100">
                    @endif
                    <col width="100">
                    <col>
                    <col width="140">
                    <col width="160">
                </colgroup>
                <thead>
                    <tr>
                        <th>번호</th>
                        @if($board->category)
                            <th>
                                <a href="#" class="sort" data-field="category">카테고리</a>
                            </th>
                        @endif
                        <th>
                            <a href="#" class="sort" data-field="top_fix">상단 고정</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="title">제목</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="author">이름</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="date">등록일</a>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @if($data->total() > 0)
                        @php
                            $pageCount = $data->currentPage() * $data->perPage();
                            $total = ($data->total() >= $data->currentPage() * $data->perPage()) ? $data->total() : $data->currentPage() * $data->perPage();
                            $pageTotal = $total - $pageCount;
                        @endphp
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $pageTotal + $loop->remaining + 1 }}</td>
                                @if($board->category)
                                    <td>{{ $item->category }}</td>
                                @endif
                                <td>
                                    @if($item->top_fix)
                                        고정
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.board.content.show', [$board->tableName, $item->id]) }}">{{ $item->title }}</a>
                                </td>
                                <td>{{ $item->author }}</td>
                                <td>{{ getDateString($item->created_at) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="td_empty">
                                <div class="empty_list" data-text="등록된 게시물이 없습니다."></div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {{ $data->links('partials.pagination.admin') }}

            <div class="btnSet">
                <a href="{{ route('admin.board.content.create', $board->tableName) }}" class="btn large">등록하기</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('/js/admin/search.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('#category').change(function() {
                location.href = '?category=' + $(this).val();
            });
        });
    </script>
@endpush

