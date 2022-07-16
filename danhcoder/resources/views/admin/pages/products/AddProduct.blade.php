@extends('admin.layouts.Index')
@section('content')
<!-- STAR CONTENT -->
<div class="content p-4">
    <div class="box-content">
        <div class="box-title dl-flex">
            <h2 class="title primary-color">THÊM MỚI SẢN PHẨM</h2>
            <p class="note-form se-color">Thêm sản phẩm thành công</p>
            <p class="link-list"> <a href="#">Xem danh sách <i class="fa-solid fa-angles-right"></i></a>
            </p>
        </div>
        <div class="form-add pt-3">
            <form action="{{ route('insertProduct') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <div class="form-row">
                            <div class="form-group col-12">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('priceSale')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="title">Tên sản phẩm</label> <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tên sản phẩm" @if( old('title') !==null )value="{{old('title') }}" @endif>
                            </div>
                            <div class="form-group col-6 pr-0">
                                <label for="price">Giá Bán</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Nhập tên sản phẩm" min="0" @if( old('price') !==null )value="{{old('price') }}" @endif>
                            </div>
                            <div class="form-group col-6 pr-0">

                                <label for="price-sale">Giá Khuyễn Mãi</label>
                                <input type="number" class="form-control" id="price-sale" name="priceSale" placeholder="Nhập tên sản phẩm" min="0" @if( old('priceSale') !==null )value="{{old('priceSale') }}" @endif>
                            </div>
                            <div class="form-group col-6 pr-0">
                                <label for="amount"> Số lượng</label>
                                <input type="number" class="form-control" id="amount" name="amount" placeholder="Nhập số lượng sản phẩm" min="0" @if( old('amount') !==null )value="{{old('amount') }}" @endif>
                            </div>
                            <div class="form-group col-6 pr-0">
                                <label for="star_rating">Đánh giá</label>
                                <input type="number" class="form-control" id="star_rating" name="starRating" placeholder="Nhập đánh giá sản phẩm" min="0" max="5" @if( old('starRating') !==null )value="{{old('starRating') }}" @endif>
                            </div>
                            <div class="form-group col-12">
                                <label for="content">Thông tin chi tiết</label>
                                <textarea name="content" id="mytextarea">@if( old('content') !== null ){{old('content') }} @endif</textarea>
                            </div>
                            <div class="form-group col-12">
                                <label for="description">Mô tả ngắn</label>
                                <textarea name="description" id="mytextareaDesc">@if( old('description') !== null ) {{old('description') }} @endif</textarea>
                            </div>
                            <div class="form-group col-12">
                                <label for="shareCode">Chia sẻ</label><br>
                                <textarea class="form-control" name="shareCode" id="share-code" placeholder="Nhập đoạn mã youtube, map,.. để chia sẻ thêm về sản phẩm">@if( old('shareCode') !== null )value= "{{old('shareCode') }}" @endif</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group col-12">
                            <label for="unit">Chuyên mục sản phẩm</label>
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
                                <input id="imgcheck99" type="hidden" class="input-gallery" name="inputGalleryAvatar" value="">
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
                        <div class="form-group col-12">
                            <label for="thumbFile">Ảnh mô tả</label>
                            <div class="box-add-gallery-thumb">
                                <p class="btn btn-se btn-gallery-thumb">Chọn ảnh mô tả</p>
                            </div>
                            <div class="box-thumb row m-0 py-2 dl-none">
                            </div>
                            <div class="box-edit-file-thumb dl-none">
                                <p class="btn btn-pr btn-edit-gallery-thumb"><i class="fa-solid fa-pen-to-square"></i></p>
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
                                        Đang bán
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status1" value="2">
                                    <label class="form-check-label" for="status1">
                                        Bán hết
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="userId">Tác giả</label>
                            <select id="userId" name="user_id" class="form-control">
                                <option value="{{ Auth::user()->id }}" selected>{{ Auth::user()->name }}</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
                        </div>
                    </div>

                </div>
        </div>
        </form>
    </div>
</div>
</div>
<!-- END CONTENT -->
@include('admin.layouts.AvatarGellery')
<!-- END CONTENT -->
@endsection