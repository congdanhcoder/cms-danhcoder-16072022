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
            <form action="{{ route('updateProduct', [ 'id'=> $product->id]) }}" method="post" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tên sản phẩm" @if( old('title') !==null )value="{{old('title') }}" @else value="{!! $product->title !!}" @endif>
                            </div>
                            <div class="form-group col-6 pr-0">
                                <label for="price">Giá Bán</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Nhập tên sản phẩm" min="0" @if( old('price') !==null )value="{{old('price') }}" @else value="{!! $product->price !!}" @endif>
                            </div>
                            <div class="form-group col-6 pr-0">

                                <label for="price-sale">Giá Khuyễn Mãi</label>
                                <input type="number" class="form-control" id="price-sale" name="priceSale" placeholder="Nhập tên sản phẩm" min="0" @if( old('priceSale') !==null )value="{{old('priceSale') }}" @else value="{!! $product->price_sale !!}" @endif>
                            </div>
                            <div class="form-group col-6 pr-0">
                                <label for="amount"> Số lượng</label>
                                <input type="number" class="form-control" id="amount" name="amount" placeholder="Nhập số lượng sản phẩm" min="0" @if( old('amount') !==null )value="{{old('amount') }}" @else value="{!! $product->amount !!}" @endif>
                            </div>
                            <div class="form-group col-6 pr-0">
                                <label for="star_rating">Đánh giá</label>
                                <input type="number" class="form-control" id="star_rating" name="starRating" placeholder="Nhập đánh giá sản phẩm" min="0" max="5" @if( old('starRating') !==null )value="{{old('starRating') }}" @else value="{!! $product->starRating !!}" @endif>
                            </div>
                            <div class="form-group col-12">
                                <label for="content">Thông tin chi tiết</label>
                                <textarea name="content" id="mytextarea">@if( old('content') !== null ){{old('content') }} @else {!! $product->content !!} @endif</textarea>
                            </div>
                            <div class="form-group col-12">
                                <label for="description">Mô tả ngắn</label>
                                <textarea name="description" id="mytextareaDesc">@if( old('description') !== null ) {{old('description') }} @else {!! $product->description !!} @endif</textarea>
                            </div>
                            <div class="form-group col-12">
                                <label for="shareCode">Chia sẻ</label><br>
                                <textarea class="form-control" name="shareCode" id="share-code" placeholder="Nhập đoạn mã youtube, map,.. để chia sẻ thêm về sản phẩm">@if( old('shareCode') !== null ){{old('shareCode') }} @else {!! $product->share_code !!} @endif</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group col-12">
                            <label for="unit">Chuyên mục sản phẩm</label>
                            <div class="box-form-check">
                                <div class="cat-current">
                                    @foreach($getCats as $getCat)
                                    <div class="item-check" style="margin-left:0px">
                                        <input type="checkbox" id="vehicle{{ $getCat->id }}" name="catIdProduct[]" value="{{ $getCat->id }}" checked onclick="return false;">
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
                            <div class="box-edit avatar @if($product->avatar <> null) dl-none @endif">
                                <div class="box-add-avatar">
                                    <p class="btn btn-se btn-gallery-avatar">Chọn ảnh đại diện</p>
                                </div>
                            </div>
                            <div class="box-avatar py-2 @if($product->avatar == null) dl-none @endif">
                                <input id="imgcheck99" type="hidden" class="input-gallery" name="inputGalleryAvatar" value="{!! $product->avatar !!}">
                                <img class="img-avatar" src="{!! asset($product->avatar) !!}">
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
                        <div class="form-group col-12">
                            <label for="thumbFile">Ảnh mô tả</label>
                            <div class="box-add-gallery-thumb">
                                <p class="btn btn-se btn-gallery-thumb">Chọn ảnh mô tả</p>
                            </div>
                            <div class="box-thumb row m-0 py-2 dl-none">
                                @foreach($imgThumbs as $imgThumb)
                                <div class="thumb-img box-thub-delete">
                                    <img src="{{ $imgThumb->slug }}" alt="" srcset="">
                                    <input class="btn-positon" type="checkbox" id="deletetumb{{ $imgThumb->id }}" name="imgDelete[]" value="{{ $imgThumb->id }}">
                                    <label for="deletetumb{{ $imgThumb->id }}" class="btn btn-delete delete-mtimg btn-se btn-positon">
                                        <i class="fa-solid fa-trash"></i></label>
                                </div>
                                @endforeach
                            </div>
                            <div class="box-edit-file-thumb dl-none">
                                <p class="btn btn-pr btn-edit-gallery-thumb"><i class=" fa-solid fa-pen-to-square"></i></p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="0" @if($product->status == 0) checked @endif>
                                    <label class="form-check-label" for="status">
                                        Bản nháp
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status1" value="1" @if($product->status == 1) checked @endif>
                                    <label class="form-check-label" for="status1">
                                        Đang bán
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status1" value="2" @if($product->status == 2) checked @endif>
                                    <label class="form-check-label" for="status1">
                                        Bán hết
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="userId">Tác giả</label>
                            <select id="userId" name="user_id" class="form-control">
                                @if(Auth::user()->id == $product->user_id || Auth::user()->positions_id == 1 || Auth::user()->positions_id == 2)
                                <option value="{{ $userProduct->id }}" selected>{{ $userProduct->name }}</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                                @else
                                <option value="{{ $userProduct->id }}" selected>{{ $userProduct->name }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
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