@extends('layouts.admin')

@section('title', $title)

@section('content')
    <section class="container">
        <div class="page-title">{{ $title }}</div>

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
                    <col width="120">
                    <col width="120">
                    <col width="150">
                    <col width="150">                    
                    <col width="300">
                    <col>
                    <col width="150"> 
                    <col width="120">
                </colgroup>
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>
                            <a href="#" class="sort" data-field="name">이름</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="co_name">회사명</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="email">이메일</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="phone">연락처</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="service">요청 서비스</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="desc">요청 내용</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="desc">파일</a>
                        </th>
                        <th>
                            <a href="#" class="sort" data-field="contact_date">제안날짜</a>
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
                                <td>{{ $item->username }}</td>                                
                                <td>{{ $item->co_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->service }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <a href="{{ route('admin.contact-download', $item->file) }}" > {{ $item->file }} </a>
                                </td>
                                <td>{{ getDateString($item->submitted_at) }}</td>                                
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
        </div>
    </section>
@endsection

@push('scripts')
    <!-- <script type="text/javascript" src="{{ asset('/js/admin/search.js') }}"></script> -->
@endpush

