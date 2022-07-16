@extends('admin.layouts.Index')
@section('content')
<!-- STAR CONTENT -->
<div class="content p-4">
    <div class="box-content">
        <div class="box-title dl-flex">
            <h2 class="title primary-color">THÊM MỚI BÀI VIẾT</h2>
            <p class="link-list"> <a href="{{ route('listPost') }}">Xem danh sách<i class="fa-solid fa-angles-right"></i></a>
            </p>
        </div>
        @if($echoCats <> null)
            <div class="form-add pt-3">
                <form action="{{ route('insertPost') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="title">Tiêu đề bài viết</label> <span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="title" name="title" @if( old('title') !==null ){!! old('title') !!} @else placeholder="Nhập tiêu đề bài viết" @endif>
                                </div>
                                <div class="form-group col-12">
                                    <label for="description">Mô tả ngắn</label>
                                    <textarea name="description" id="description">@if( old('description') !== null ){!! old('description') !!}@endif</textarea>
                                </div>
                                <div class="form-group col-12">
                                    <label for="content">Nội dung</label>
                                    <textarea name="content" id="mytextarea">@if(old('description') !== null) ){!! old('content') !!}@endif</textarea>
                                </div>
                                <div class="form-group col-6">
                                    <label for="userId">Tác giả</label>
                                    <select id="userId" name="user_id" class="form-control">
                                        <option value="{{ Auth::user()->id }}" selected>{{ Auth::user()->name }}</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Tắt bật Index </label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="index" id="index" value="0" checked>
                                            <label class="form-check-label" for="index">
                                                Cho phép Index
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="index" id="index1" value="1">
                                            <label class="form-check-label" for="index1">
                                                Chặn Index
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group col-12">
                                <label for="cat-post">Chuyên mục bài viết</label>
                                <div class="box-form-check">
                                    @foreach($echoCats as $echoCat)
                                    {!! $echoCat->render_checkbox !!}
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="content">Ảnh đại diện</label>
                                <div class="box-add-avatar">
                                    <p class="btn btn-se btn-gallery-avatar">Chọn ảnh đại diện</p>
                                </div>
                                <div class="box-avatar py-2 dl-none">
                                    <input id="inputGallery" type="hidden" class="input-gallery" name="inputGallery" value="">
                                    <img class="img-avatar" src="" alt="" srcset="">
                                    <div class="btn-positon">
                                        <p class="delete-avatar-gallery btn btn-delete btn-se">
                                            <i class="fa-solid fa-trash"></i>
                                        </p>
                                        <div class="page-add ">
                                            <p class="btn btn-pr btn-avatar-edit"><i class="fa-solid fa-pen-to-square"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Trạng thái</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status" value="0" checked>
                                        <label class="form-check-label" for="status">
                                            Bản nháp
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status1" value="1">
                                        <label class="form-check-label" for="status1">
                                            Đăng
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <button type="submit" class="btn btn-primary">Lưu bài viết</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            @else
            <p>Hãy thêm danh mục bài viết trước! <a href="{{ route('listCatPost') }}" class="btn btn-se"> Thêm danh mục bài viết</a></p>
            @endif
    </div>
</div>
@include('admin.layouts.AvatarGellery')
<!-- END CONTENT -->
@endsection