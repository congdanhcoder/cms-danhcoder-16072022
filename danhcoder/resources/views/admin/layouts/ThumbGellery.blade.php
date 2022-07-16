{{$gallerys->count()}}
<div class="box-content gallery-add-thumb">
    <div class="box-title dl-flex">
        <h2 class="title primary-color">GALLERY</h2>
        <p class="btn btn-se off-gallery-thumb"><i class="fa-solid fa-calendar-xmark"></i>
        </p>
    </div>
    <div class="box-gallery">
        @if($gallerys->count() > 0)
        @foreach($gallerys as $gallery)
        <div class="box-img item-more">
            <img src="{{ $gallery->slug }}">
            <div class="btn-positon">
                <input type="checkbox" name="check-thumb[]" value="{{ $gallery->slug }}">
            </div>
        </div>
        @endforeach
        @else
        <p>Không có hình ảnh trong thư viện!</p>
        @endif
    </div>
    <div class="box-more py-2">
        <p class="btn-more btn btn-se">Xem thêm</p>
    </div>
    <div class="btn-add-rad text-center py-2">
        <p class="btn add-thumb-check btn-pr">Chọn Ảnh</p>
    </div>
</div>