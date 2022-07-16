@extends('admin.layouts.Index')
@section('content')
<!-- STAR CONTENT -->
<div class="content p-4">
    <div class="box-content">
        <div class="box-title dl-flex">
            <h2 class="title primary-color">DANH SÁCH BÀI VIẾT</h2>
            <p class="note-form se-color"> {{session()->get('sessionStatus')}}</p>
            <p class="link-list"> <a href="{{ route('listPost') }}">Xem danh sách<i class="fa-solid fa-angles-right"></i></a>
            </p>
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
            <tbody>
                @foreach($posts as $post)
                @php
                $stt ++;
                @endphp
                <tr class="item-more">
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
                            @if(Auth::user()->positions_id == 1 || Auth::user()->positions_id == 2 || Auth::user()->positions_id == 3 || Auth::user()->positions_id == 4)
                            <a href="edit-post/{!! $post->id !!}">
                                <p class="btn btn-edit btn-pr">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </p>
                            </a>
                            </a>
                            <a href="delete-post/{!! $post->id !!}">
                                <p class="btn btn-delete btn-se">
                                    <i class="fa-solid fa-trash-can"></i>
                                </p>
                            </a>
                            @endif
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
        <div class="box-more text-center">
            <p class="btn-more btn btn-se">Xem thêm</p>
        </div>
        @else
        <p>Không có bài viết!</p>
        @endif
    </div>
    <div class="box-content">
        <div class="box-customer">
            <div class="box-title dl-flex">
                <h2 class="title primary-color">KHÁCH HÀNG</h2>
                <p class="link-list"> <a href="#">Xem danh sách <i class="fa-solid fa-angles-right"></i></a>
                </p>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            <p>1</p>
                        </th>
                        <td>
                            <p>Nguyễn Khánh</p>
                        </td>
                        <td>
                            <p class="customer-phone btn-se btn"><a href="tel:09886666">09886666</a></p>
                        </td>
                        <td>
                            <div class="box-action dl-flex">
                                <p class="btn btn-edit btn-pr"><a href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                                </p>
                                <p class="btn btn-delete btn-se"><a href="#"><i class="fa-solid fa-trash-can"></i></a>
                                </p>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="box-content">
        <div class="box-product">
            <div class="box-title dl-flex">
                <h2 class="title primary-color">SẢN PHẨM MỚI</h2>
                <p class="link-list"> <a href="#">Xem danh sách <i class="fa-solid fa-angles-right"></i></a>
                </p>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Chuyên mục</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            <p>1</p>
                        </th>
                        <td>
                            <p>Nguyễn Khánh</p>
                        </td>
                        <td>
                            <p>Nhà đất bán</p>
                        </td>
                        <td class="stratus">
                            <p class="btn-sold btn-se btn">Đã bán</p>

                        </td>
                        <td>
                            <div class="box-action dl-flex">
                                <p class="btn btn-edit btn-pr"><a href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                                </p>
                                <p class="btn btn-delete btn-se"><a href="#"><i class="fa-solid fa-trash-can"></i></a>
                                </p>
                                <p class="btn btn-eye btn-su"><a href="#" target="_blank"><i class="fa-solid fa-eye"></i></a>
                                </p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <p>2</p>
                        </th>
                        <td>
                            <p>Nguyễn Khánh</p>
                        </td>
                        <td>
                            <p>Nhà đất bán</p>
                        </td>
                        <td class="stratus">
                            <p class="btn-post btn-pr btn">Đang bán</p>
                        </td>
                        <td>
                            <div class="box-action dl-flex">
                                <p class="btn btn-edit btn-pr"><a href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                                </p>
                                <p class="btn btn-delete btn-se"><a href="#"><i class="fa-solid fa-trash-can"></i></a>
                                </p>
                                <p class="btn btn-eye btn-su"><a href="#" target="_blank"><i class="fa-solid fa-eye"></i></a>
                                </p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <p>3</p>
                        </th>
                        <td>
                            <p>Nguyễn Khánh</p>
                        </td>
                        <td>
                            <p>Nhà đất bán</p>
                        </td>
                        <td class="stratus">
                            <p class="btn-draft btn-su btn">Bản nháp</p>
                        </td>
                        <td>
                            <div class="box-action dl-flex">
                                <p class="btn btn-edit btn-pr"><a href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                                </p>
                                <p class="btn btn-delete btn-se"><a href="#"><i class="fa-solid fa-trash-can"></i></a>
                                </p>
                                <p class="btn btn-eye btn-su"><a href="#" target="_blank"><i class="fa-solid fa-eye"></i></a>
                                </p>
                            </div>
                        </td>
                    </tr>

                </tbody>


            </table>
        </div>
    </div>
</div>
<!-- END CONTENT -->
@endsection