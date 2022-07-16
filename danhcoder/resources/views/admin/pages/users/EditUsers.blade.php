@extends('admin.layouts.Index')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="box-title dl-flex">
                        <h2 class="title primary-color">THÔNG TIN USER</h2>
                        <p class="link-list"> <a href="{{ route('listUser') }}">Xem danh sách<i class="fa-solid fa-angles-right"></i></a>
                        </p>
                    </div>
                    <form method="POST" action="{{ route('updateUser', ['id' => $user->id]) }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nhập Họ và Tên</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control is-invalid" name="name" value="@if(old('name') !== null) {{ old('name') }} @else {{ $user->name }}@endif" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Địa chỉ Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control is-invalid" name="email" value="@if(old('email') !== null) {{ old('email') }} @else {{ $user->email }}@endif" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Số điện thoại</label>
                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control is-invalid" name="phone" value="@if(old('phone') !== null){{ old('phone') }}@else{{ $user->phone }}@endif" required autocomplete="phone">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="roleId" class="col-md-4 col-form-label text-md-end">Phân quyền</label>
                            <div class="col-md-6">
                                <select id="roleId" name="roleId" class="form-control is-invalid">
                                    @foreach($positions as $position)
                                    @if(Auth::user()->positions_id == 1)
                                    <option value="{{ $position->id }}" @if($position->id == $user->positions_id)selected @endif> {{ $position->title }}</option>
                                    @elseif(Auth::user()->positions_id == 2 && $position->id <> 1)
                                        <option value="{{ $position->id }}" @if($position->id == $user->positions_id)selected @endif> {{ $position->title }}</option>
                                        @elseif($position->id == $user->positions_id)
                                        <option value="{{ $position->id }}" selected> {{ $position->title }}</option>
                                        @endif
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Trạng thái</label>
                            <div class="form-check mx-2 ml-3">
                                <input class="form-check-input" type="radio" name="status" id="status" value="0" @if($user->status == 0) checked @endif>
                                <label class="form-check-label" for="status">
                                    Tạm dừng
                                </label>
                            </div>
                            <div class="form-check mx-2">
                                <input class="form-check-input" type="radio" name="status" id="status1" value="1" @if($user->status == 1) checked @endif>
                                <label class="form-check-label" for="status1">
                                    Hoạt động
                                </label>
                            </div>
                        </div>
                        <div class="row mb-3 box-reset-password">
                            <label for="resetPassword" class="col-md-4 col-form-label text-md-end">Thay đổi mật khẩu</label>
                            <div class="col-md-6">
                                <input id="resetPassword" type="password" class="form-control is-invalid" name="resetPassword" autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-se">
                                    Lưu User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection