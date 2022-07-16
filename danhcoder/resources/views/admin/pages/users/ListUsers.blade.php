@extends('admin.layouts.Index')
@section('content')
<!-- STAR CONTENT -->
<div class="content p-4">
    <div class="box-content">
        <div class="box-title dl-flex">
            <h2 class="title primary-color">DANH SÁCH BÀI VIẾT</h2>
            <p class="note-form se-color"> {{session()->get('sessionStatus')}}</p>
            <div class="form-seach pb-3">
                <form class="form-inline" action="">
                    <input class="form-control p-1 btn-outline-danger" type="text" placeholder="Từ khoá tìm kiếm">
                    <button class="btn btn-outline-danger p-1" type="submit">Tìm kiếm</button>
                </form>
            </div>
        </div>
        @if($users->count() > 0)
        @php
        $stt = 0;
        @endphp
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Liên hệ</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                @php
                $stt ++;
                @endphp
                <tr class="item-user">
                    <th scope="row">
                        <p>{!! $stt !!}</p>
                    </th>
                    <td>
                        <p>{!! $user->name !!}</p>
                    </td>
                    <td>
                        @if($user->phone <> null)
                            <a href="tel:{!! $user->phone !!}">
                                <p class="customer-phone btn-se btn">{!! $user->phone !!}</p>
                            </a>
                            @else
                            <p class="customer-phone btn-se btn">{!! $user->email !!}</p>
                            @endif

                    </td>
                    <td class="stratus">
                        @if($user->status == 0)
                        <p class="btn-draft btn-su btn">Tạm ngưng</p>
                        @else
                        <p class="btn-sold btn-se btn">Hoạt động</p>
                        @endif
                    </td>
                    <td>
                        <div class="box-action dl-flex">
                            <a href="edit-user/{!! $user->id !!}">
                                <p class="btn btn-edit btn-pr">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </p>
                            </a>
                            <a href="delete-user/{!! $user->id !!}">
                                <p class="btn btn-delete btn-se">
                                    <i class="fa-solid fa-trash-can"></i>
                                </p>
                            </a>
                            <a href="show-user/{!! $user->id !!} " target="_blank">
                                <p class="btn btn-eye btn-su">
                                    <i class="fa-solid fa-eye"></i>
                                </p>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="link-page">
            {{ $users->links() }}
        </div>
        @else
        <p>Không có User!</p>
        @endif
    </div>
</div>
<!-- END CONTENT -->
@endsection