@extends('admin.layouts.Index')
@section('content')
<!-- STAR CONTENT -->
<div class="content p-4">
    <div class="row">
        <div class="col-12">
            <div class="box-content">
                <div class="box-title dl-flex">
                    <h2 class="title primary-color">SỬA DANH MỤC</h2>
                </div>
                <form action="{{ route('updateCatPost',['id' => $cat->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-12">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="title">Tên danh mục</label> <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Nhập danh mục" value="@if( old('title') !== null ){!! old('title') !!} @else {!! $cat->title !!} @endif">
                        </div>
                        <div class="form-group col-12">
                            <label for="description">Mô tả ngắn</label>
                            <textarea name="description" id="description">@if( old('description') !== null ){!! old('description') !!} @else {!! $cat->description !!} @endif</textarea>
                        </div>
                        <div class="form-group col-12">
                            <label for="content">Nội dung</label>
                            <textarea name="content" id="mytextarea">@if( old('content') !== null ){!! old('content') !!} @else {!! $cat->content !!} @endif</textarea>
                        </div>
                        <div class="form-group col-6">
                            <label for="unit">Danh mục cha</label>
                            <select id="parent_id" name="parent_id" class="form-control">
                                @if($catParent <> null)
                                    <option value="{{ $catParent->id }}">
                                        {{ $catParent->title }}
                                    </option>
                                    @endif
                                    <option value="0">
                                        Trống
                                    </option>
                                    @foreach($echoCats as $echoCat)
                                    {!! $echoCat->render_select !!}
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="content">Ảnh đại diện</label>
                            <div class="box-edit avatar @if($cat->avatar <> null) dl-none @endif">
                                <div class="row">
                                    <div class="col-9 file-avatar">
                                        <input style="padding: 0px;" type="file" name="avatarFile" accept=".png,.jpge,.jpg" class="form-control file">
                                    </div>
                                    <div class="col-3">
                                        <p class="btn btn-se btn-gallery-avatar">Gallery</p>
                                    </div>
                                </div>
                            </div>
                            <div class="box-avatar py-2 @if($cat->avatar == null) dl-none @endif">
                                <input id="imgcheck99" type="hidden" class="input-gallery" name="inputGallery" value="{!! $cat->avatar !!}">
                                <img class="img-avatar" src="{!! asset($cat->avatar) !!}">
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
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu danh mục</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('admin.layouts.AvatarGellery')
<!-- END CONTENT -->
@endsection