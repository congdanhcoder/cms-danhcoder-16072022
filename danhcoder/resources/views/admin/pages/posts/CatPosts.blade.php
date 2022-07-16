@extends('admin.layouts.Index')
@section('content')
<!-- STAR CONTENT -->
<div class="content p-4">
    <div class="row">
        <div class="col-4">
            <div class="box-content">
                <div class="box-title dl-flex">
                    <h2 class="title primary-color">THÊM DANH MỤC</h2>
                </div>
                <form action="{{ route('addCatPost') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="title">Tên danh mục</label> <span class="text-danger">*</span>
                            <input type="text" class="form-control" name="title" placeholder="Nhập danh mục">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="cat_prent">Danh mục cha</label>
                            <select id="parent_id" name="parent_id" class="form-control">
                                <option value="0" selected>Trống</option>
                                @if($echoCats <> null)
                                    @foreach($echoCats as $echoCat)
                                    {!! $echoCat->render_select !!}
                                    @endforeach
                                    @endif
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                </form>
            </div>
        </div>
        <div class="col-8">
            <div class="box-content">
                <div class="box-title dl-flex">
                    <h2 class="title primary-color">DANH SÁCH DANH MỤC</h2>
                    <p class="note-form se-color"> {{session()->get('sessionStatus')}}</p>
                </div>
                @if($echoCats <> null)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($echoCats as $echoCat)
                            {!! $echoCat->render_table !!}
                            @endforeach
                        </tbody>
                    </table>
                    <div class="box-more text-center">
                        <p class="btn-more btn btn-se">Xem thêm</p>
                    </div>
                    @else
                    <p>Không có danh mục!</p>
                    @endif
            </div>
        </div>

    </div>
</div>
<!-- END CONTENT -->
@endsection