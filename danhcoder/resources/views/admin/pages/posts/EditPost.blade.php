@extends('admin.layouts.Index')
@section('content')
<!-- STAR CONTENT -->
<div class="content p-4">
    <div class="box-content">
        <div class="box-title dl-flex">
            <h2 class="title primary-color">CHỈNH SỬ BÀI VIẾT</h2>
            <p class="note-form se-color">Thêm sản phẩm thành công</p>
            <p class="link-list"> <a href="{{ route('listPost') }}">Xem danh sách<i class="fa-solid fa-angles-right"></i></a>
            </p>
        </div>
        <div class="form-add pt-3">
            <form action="{{ route('updatePost', ['id' =>  $post->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <div class="form-row">
                            <div class="form-group col-12">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="title">Tiêu đề bài viết</label> <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="title" name="title" value="@if( old('title') !== null ){{ old('title') }} @else {{ $post->title }}@endif">
                            </div>
                            <div class="form-group col-12">
                                <label for="description">Mô tả ngắn</label>
                                <textarea name="description" id="description">@if( old('description') !== null ){{ old('description') }} @else {{ $post->description }}@endif</textarea>
                            </div>
                            <div class="form-group col-12">
                                <label for="content">Nội dung</label>
                                <textarea name="content" id="mytextarea">@if( old('content') !== null ){{ old('content') }} @else {{ $post->content }}@endif</textarea>
                            </div>
                            <div class="form-group col-6">
                                <label for="userId">Tác giả</label>
                                <select id="userId" name="user_id" class="form-control">
                                    @if(Auth::user()->id == $post->user_id || Auth::user()->positions_id == 1 || Auth::user()->positions_id == 2)
                                    <option value="{{ $userPost->id }}" selected>{{ $userPost->name }}</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                    @else
                                    <option value="{{ $userPost->id }}" selected>{{ $userPost->name }}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Tắt bật Index </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="index" id="index" value="0" @if($post->index == 0) checked @endif>
                                        <label class="form-check-label" for="index">
                                            Cho phép Index
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="index" id="index1" value="1" @if($post->index == 1) checked @endif>
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
                                <div class="cat-current">
                                    @foreach($getCats as $getCat)
                                    <div class="item-check" style="margin-left:0px">
                                        <input type="checkbox" id="vehicle{{ $getCat->id }}" name="catIdPost[]" value="{{ $getCat->id }}" checked onclick="return false;">
                                        <label style="margin-left: 5px" for="vehicle{{ $getCat->id }}" class="form-check-label">{{ $getCat->title }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="edit-cat">
                                    <p class="btn btn-se btn-on-edit-cat">Chỉnh sửa</p>
                                    <p class="btn btn-su btn-off-edit-cat dl-none" style="max-width: 95px;">Huỷ</p>
                                </div>
                                <div class="cat-update dl-none">
                                    @foreach($echoCats as $echoCat)
                                    {!! $echoCat->render_checkbox !!}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="content">Ảnh đại diện</label>
                            <div class="box-edit avatar @if($post->avatar <> null) dl-none @endif">
                                <div class="row">
                                    <div class="col-9 file-avatar">
                                        <input style="padding: 0px;" type="file" name="avatarFile" accept=".png,.jpge,.jpg" class="form-control file">
                                    </div>
                                    <div class="col-3">
                                        <p class="btn btn-se btn-gallery-avatar">Gallery</p>
                                    </div>
                                </div>
                            </div>
                            <div class="box-avatar py-2 @if($post->avatar == null) dl-none @endif">
                                <input id="imgcheck99" type="hidden" class="input-gallery" name="inputGallery" value="{!! $post->avatar !!}">
                                <img class="img-avatar" src="{!! asset($post->avatar) !!}">
                                <div class="btn-positon">
                                    <p class="delete-avatar-gallery btn btn-delete btn-se">
                                        <i class="fa-solid fa-trash"></i>
                                    </p>
                                    <div class="box-edit-file-avatar">
                                        <p class="btn btn-pr btn-avatar-edit"><i class="fa-solid fa-pen-to-square"></i></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="0" @if($post->status == 0) checked @endif>
                                    <label class="form-check-label" for="status">
                                        Bản nháp
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status1" value="1" @if($post->status == 1) checked @endif>
                                    <label class="form-check-label" for="status1">
                                        Đăng
                                    </label>
                                </div>
                            </div>
                        </div>
                        @if(Auth::user()->id == $post->user_id)
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-primary">Lưu bài viết</button>
                        </div>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('admin.layouts.AvatarGellery')
<!-- END CONTENT -->
@endsection