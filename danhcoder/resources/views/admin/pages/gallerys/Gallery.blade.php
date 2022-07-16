@extends('admin.layouts.Index')
@section('content')
<!-- STAR CONTENT -->
<div class="content p-4">
    <div class="box-content box-upload">
        <div class="box-title">
            <h2 class="title primary-color">UPLOAD HÌNH ẢNH LÊN WEBSITE <span class="up-load-img"><i class="fa-solid fa-rectangle-xmark"></i></span></h2>
        </div>
        <div class="upload-">
            <form method="POST" enctype="multipart/form-data" class="formUploadAjax" action="{{ route('uploadAjaxImg') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" name="file[]" multiple placeholder="Choose File" id="file">
                            <span class="text-danger">{{ $errors->first('file') }}</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-se">Upload File</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="box-content">
        <div class="box-title dl-flex">
            <h2 class="title primary-color">GALLERY <span class="up-load-img"><i class="fa-solid fa-upload"></i></span></h2>
            <p class="note-form se-color">{{ session()->get('sessionStatus')}}</p>
        </div>
        <div class="box-gallery">
            @if($gallerys->count() > 0)
            @foreach($gallerys as $gallery)
            <div class="box-img">
                <img src="{{ $gallery->slug }}">
                <p class="btn btn-delete btn-se btn-delete-image" data-url="{{ $gallery->slug }}" id-image="{{ $gallery->id }}">
                    <i class="fa-solid fa-trash-can"></i>
                </p>
                <div class="btn-positon">
                    <p class="btn copy-content btn-pr" data-url="{{ $gallery->slug }}">
                        <i class="fa-solid fa-copy"></i>
                    </p>
                    <a href="{{ asset($gallery->slug) }}" target="_blank">
                        <p class="btn btn-eye btn-su">
                            <i class="fa-solid fa-eye"></i>
                        </p>
                    </a>
                </div>
            </div>

            @endforeach
            @else
            <p>Không có hình ảnh trong thư viện!</p>
            @endif
        </div>
        <div class="box-more-img-ajax mt-3 text-center" style="display: {{ $btnMore }};">
            <p class="btn-more-img-ajax btn btn-se" number-data="5">Xem thêm</p>
        </div>
    </div>

</div>

<!-- END CONTENT -->
@endsection