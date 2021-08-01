@extends('layouts.admin')

@section('title', $title)

@section('content')
    <section class="container">
        <div class="page-title">{{ $title }}</div>

        <form id="searchForm" action="" method="get">
            <input type="hidden" id="search" name="search" value="{{ $search }}">

            <div class="data-search-wrap">
                <div class="data-sel">
                    <select id="search_type" name="search_type">
                        <option value="">검색항목</option>
                        <option value="table_name">테이블 이름</option>
                        <option value="name">게시판 이름</option>
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
                    <col width="200">
                    <col>
                    <col width="60">
                    <col width="140">
                    <col width="140">
                </colgroup>
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>
                            <a href="#" class="sort" data-field="table_name">테이블 이름</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="name">게시판 이름</a>
                        </th>
                        <th>수</th>
                        <th>
                            <a href="#" class="sort" data-field="register">등록자</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="created_at">등록일</a>
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
                                <td>{{ $item->tableName }}</td>
                                <td>
                                    <a href="{{ route('admin.board.show', $item->id) }}">{{ $item->name }}</a>
                                </td>
                                <td>{{ $item->itemCountPerPage }}</td>
                                <td>{{ $item->user->username }}</td>
                                <td>{{ getDateString($item->created_at) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="td_empty">
                                <div class="empty_list" data-text="등록된 게시물이 없습니다."></div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {{ $data->links('partials.pagination.admin') }}

            <div class="btnSet">
                <a href="{{ route('admin.board.create') }}" class="btn large">등록하기</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('/js/admin/search.js') }}"></script>
@endpush


