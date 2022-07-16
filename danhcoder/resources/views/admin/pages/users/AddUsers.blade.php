@extends('admin.layouts.Index')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="box-title dl-flex">
                        <h2 class="title primary-color">THÊM MỚI USER</h2>
                        <p class="link-list"> <a href="{{ route('listUser') }}">Xem danh sách<i class="fa-solid fa-angles-right"></i></a>
                        </p>
                    </div>
                    <form method="POST" action="{{ route('insertUser') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nhập Họ và Tên</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control is-invalid" name="name" value="{{ old('name') }}" required>
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
                                <input id="email" type="email" class="form-control is-invalid" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="phone" type="tel" class="form-control is-invalid" name="phone" value="{{ old('phone') }}" required autocomplete="phone"">
                                @error('phone')
                                <span class=" invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Mật khẩu</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control is-invalid" name="password" required autocomplete="new-password">
                                @error('password')
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
                                    @if($position->id <>1)
                                        <option value="{{ $position->id }}" @if($position->id == 5 )selected @endif>{{ $position->title }}</option>
                                        @endif
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-se">
                                    Thêm User
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