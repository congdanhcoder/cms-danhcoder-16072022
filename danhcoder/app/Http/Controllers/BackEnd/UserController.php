<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
/* import model */

use Illuminate\Pagination\Paginator;
use App\Models\User;
use App\Models\Position;
use App\Models\Users_and_roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


/* import function helper */
use App\Helper\Recusive;
use App\Helper\FomatSlug;
use App\Helper\File;
use App\Models\Post;

use function PHPUnit\Framework\returnSelf;

/* ------- */

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //

    function __construct()
    {
        /* chạy lệnh này để khắc phục thanh phân trang bị bể */
        Paginator::useBootstrap();
    }

    function listUser()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('admin.pages.users.ListUsers', compact('users'));
    }
    function addUser()
    {
        $positions = Position::orderBy('id', 'DESC')->get();
        return view('admin.pages.users.AddUsers', compact('positions'));
    }
    function insertUser(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|unique:users|regex:/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/s',
                'phone' => 'required|max:11|regex:/^[0-9-+]+$/',
                'password' => 'required|min:8'
            ],
            [
                'name.required' => 'Tiêu đề không được trống',
                'name.max' => 'Tiêu đề khốt vượt quá 255 ký tự không được trống',

                'phone.unique' => 'Số điện thoại đã tồn tại',
                'phone.max' => 'Số điện thoại không đúng định dạng',
                'phone.regex' => 'Số điện thoại không đúng định dạng',

                'email.unique' => 'Email đã tồn tại',
                'email.required' => 'Email không được để trống',
                'email.regex' => 'Email không đúng định dạng',

                'password.min' => 'Mật khẩu ít nhất 8 ký tự',
                'password.required' => 'Mật khẩu không được để trống',
            ]
        );
        $userInsert = User::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'phone' =>  $request->phone,
            'positions_id' => $request->roleId,
            'status' => 0,
            'password' => Hash::make($request->password),
        ]);

        $request->session()->flash('sessionStatus', "Thêm dữ liệu thành công");
        return redirect()->route('listUser');
    }

    function editUser($id)
    {
        $positions = Position::orderBy('id', 'DESC')->get();
        $user = User::find($id);
        return view('admin.pages.users.EditUsers', compact('user', 'positions'));
    }
    function updateUser(Request $request)
    {
        $idUser = $request->id;
        $userCurre = User::find($idUser);
        $vali = array();
        if ($request->resetPassword <> null) {
            $vali['resetPassword'] = 'required|min:8';
            $passReset = Hash::make($request->resetPassword);
        } else {
            $passReset = $userCurre['password'];
        }

        if ($request->email <> $userCurre['email']) {
            $vali['email'] = 'required|unique:users|regex:/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/s';
        }
        if ($request->phone <> $userCurre['phone']) {
            $vali['phone'] = 'required|max:11|regex:/^[0-9-+]+$/';
        }
        $request->validate(
            $vali,
            [
                'name.required' => 'Tiêu đề không được trống',
                'name.max' => 'Tiêu đề khốt vượt quá 255 ký tự không được trống',

                'phone.unique' => 'Số điện thoại đã tồn tại',
                'phone.max' => 'Số điện thoại không đúng định dạng',
                'phone.regex' => 'Số điện thoại không đúng định dạng',

                'email.unique' => 'Email đã tồn tại',
                'email.required' => 'Email không được để trống',
                'email.regex' => 'Email không đúng định dạng',

                'resetPassword.min' => 'Mật khẩu ít nhất 8 ký tự',
                'resetPassword.required' => 'Mật khẩu không được để trống',
            ]
        );
        User::where('id', $idUser)->update([
            'name' => $request->name,
            'email' =>  $request->email,
            'phone' =>  $request->phone,
            'positions_id' => $request->roleId,
            'status' => $request->status,
            'password' => $passReset,
        ]);


        $request->session()->flash('sessionStatus', "Cập nhập thành công");
        return redirect()->route('listUser');
    }

    function deleteUser(Request $request, $id)
    {
        $userDelete = User::find($id);
        if ($userDelete['positions_id'] == 1 || $userDelete['positions_id'] == 2) {
            $request->session()->flash('sessionStatus', "Không thể xoá tài khoản này!");
            return redirect()->route('listUser');
        } else {
            Post::where('user_id', $id)->update([
                'user_id' => 2
            ]);
            User::where('id', $id)->delete();
            $request->session()->flash('sessionStatus', "Đã xoá User thành công");
        }
    }
}
