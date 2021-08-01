@extends('layouts.admin')

@section('title', $title)

@section('content')
    <section class="container">
        <div class="page-title">{{ $title }}</div>

        <form name="" action="" method="post">
            <input type="hidden" id="search" name="search" value="{{ $search }}">

            <div class="data-search-wrap">
                <div class="data-sel">
                    <select id="search_type" name="search_type">
                        <option>검색항목</option>
                        <option value="code">회원번호</option>
                        <option value="name">이름</option>
                        <option value="cellphone">휴대폰</option>
                        <option value="birthday">생년월일</option>
                        <option value="address">주소</option>
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
                    <col width="150">
                    <col width="100">
                    <col width="120">
                    <col width="120">
                    <col>
                    <col width="140">
                    <col width="140">
                </colgroup>
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>
                            <a href="#" class="sort" data-field="code">회원번호</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="name">이름</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="cellphone">휴대폰</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="birthday">생년월일</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="address">주소</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="join_date">가입일</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="last_login_date">최근 로그인</a>
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
                                <td>{{ $item->code }}</td>
                                <td>
                                    <a href="{{ route('admin.master.show', $item->code) }}">{{ $item->name }}</a>
                                </td>
                                <td>{{ $item->cellphone }}</td>
                                <td>{{ $item->birthday }}</td>
                                <td>{{ $item->address }} {{ $item->adderss_detail }}</td>
                                <td>{{ getDateString($item->created_at) }}</td>
                                <td>{{ getDateString($item->last_login_at) }}</td>
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
                <a href="{{ route('admin.master.create') }}" class="btn large">등록하기</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('/js/admin/search.js') }}"></script>
@endpush

