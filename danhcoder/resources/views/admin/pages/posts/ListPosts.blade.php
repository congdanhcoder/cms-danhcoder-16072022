@extends('admin.layouts.Index')
@section('content')
<!-- STAR CONTENT -->
<div class="content p-4">
    <div class="box-content">
        <div class="box-title dl-flex">
            <h2 class="title primary-color">DANH SÁCH BÀI VIẾT</h2>
            <p class="note-form se-color"> {{session()->get('sessionStatus')}}</p>
            <div class="form-seach pb-3 dl-flex">
                <form class="form-inline" id="seachPost">
                    <input id="inputSeachPost" class="form-control p-1 btn-outline-danger" type="text" data-url="{{ route('seachPost') }}" placeholder="Từ khoá tìm kiếm">
                    <button class="btn btn-outline-danger p-1" type="submit">Tìm kiếm</button>
                </form>
                <div class="box-out-seach">
                    <a href="{{ route('listPost') }}" class="link-out-seach"></a>
                </div>
            </div>

        </div>
        @if($posts->count() > 0)
        @php
        $stt = 0;
        @endphp
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Bài viết</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Tác vụ</th>
                </tr>
            </thead>
            <tbody class="contentListPost">
                @foreach($posts as $post)
                @php
                $stt ++;
                @endphp
                <tr class="item-post">
                    <th scope="row">
                        <p>{!! $stt !!}</p>
                    </th>
                    <td>
                        <p>{!! $post->title !!}</p>
                    </td>
                    <td class="stratus">
                        @if($post->status == 0)
                        <p class="btn-draft btn-su btn">Bản nháp</p>
                        @else
                        <p class="btn-sold btn-se btn">Đăng</p>
                        @endif
                    </td>
                    <td>
                        <div class="box-action dl-flex">
                            <a href="edit-post/{!! $post->id !!}">
                                <p class="btn btn-edit btn-pr">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </p>
                            </a>
                            <a href="delete-post/{!! $post->id !!}">
                                <p class="btn btn-delete btn-se">
                                    <i class="fa-solid fa-trash-can"></i>
                                </p>
                            </a>
                            <a href="{{ asset($post->slug) }}" target="_blank">
                                <p class="btn btn-eye btn-su">
                                    <i class="fa-solid fa-eye"></i>
                                </p>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="link-page">
            {{ $posts->links() }}
        </div>
        @else
        <p>Không có bài viết!</p>
        @endif
    </div>
</div>
<!-- END CONTENT -->
@endsection