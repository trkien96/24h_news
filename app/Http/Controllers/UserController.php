<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class UserController extends Controller
{
    public function getDangnhapAdmin()
    {
        return view('admin.login');
    }

    public function postDangnhapAdmin(Request $request)
    {
        $email = $request->old('email');
        $this->validate($request,
        [
            'email'=>'required|email',
            'password'=>'required:min:3|max:32',
        ],
        [
            'email.required'=>'Bạn phải email',
            'email.email'=>'Email không đúng định dạng',
            'password.required'=>'Bạn phải nhập mật khẩu',
            'password.min'=>'Mật khẩu phải chứa ít nhất 3 ký tự',
            'password.max'=>'Mật khẩu chứa tối đa 32 ký tự'
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            $username =Auth::user()->name;
            session()->put('user_login',$username);
            return redirect('admin/theloai/danhsach');
        }
        else
        {
            return redirect('admin/dangnhap')->with('loi','Email hoặc mật khẩu không đúng');
        }
    }

    public function getDangxuatAdmin()
    {
        Auth::logout();
        session()->forget('user_login');
        return redirect('admin/dangnhap');
    }

    public function getDanhSach()
    {
        $user = User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }

    public function getThem()
    {
        return view('admin.user.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
        [
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required:min:3|max:32',
            're-password'=>'required|same:password'
        ],
        [
            'name.required'=>'Bạn phải nhập tên',
            'name.min'=>'Tên phải chứa ít nhất 3 ký tự',
            'email.required'=>'Bạn phải email',
            'email.email'=>'Email không đúng định dạng',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Bạn phải nhập mật khẩu',
            'password.min'=>'Mật khẩu phải chứa ít nhất 3 ký tự',
            'password.max'=>'Mật khẩu chứa tối đa 32 ký tự',
            're-password.required'=>'Bạn phải nhập lại mật khẩu',
            're-password.same'=>'Mật khẩu phải giống nhau',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = $request->level;
        $user->save();
        return redirect('admin/user/them')->with('thongbao','Thêm user thành công');
    }

    public function getSua($id)
    {
        $user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }

    public function postSua(Request $request,$id)
    {
        $this->validate($request,
            [
                'name'=>'required|min:3'
            ],
            [
                'name.required'=>'Bạn phải nhập tên',
                'name.min'=>'Tên phải chứa ít nhất 3 ký tự'
            ]);
        $user = User::find($id);
        $user->name = $request->name;
        if($request->changePass=="on")
        {
            $this->validate($request,
            [
                'password'=>'required:min:3|max:32',
                're-password'=>'required|same:password'
            ],
            [
                'password.required'=>'Bạn phải nhập mật khẩu',
                'password.min'=>'Mật khẩu phải chứa ít nhất 3 ký tự',
                'password.max'=>'Mật khẩu chứa tối đa 32 ký tự',
                're-password.required'=>'Bạn phải nhập lại mật khẩu',
                're-password.same'=>'Mật khẩu phải giống nhau',
            ]);
            $user->password = bcrypt($request->password);
        }
        $user->quyen = $request->level;
        $user->save();
        return redirect('admin/user/sua/'.$id)->with('thongbao','Sửa user thành công');
    }

    public function getXoa($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach');
    }
}
