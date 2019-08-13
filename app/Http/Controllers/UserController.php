<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;

class UserController extends Controller
{
    public function getDangnhap()
    {
        return view('page.dangnhap');
    }

    public function postDangnhap(Request $request)
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
            $user =Auth::user();
            session()->put('user_login',$user);
            if($user->quyen == 1)
            {
                return redirect('admin/dashboard');
            }
            else
            {
                return redirect('trangchu');
            }
        }
        else
        {
            return redirect()->back()->with('loi','Thông tin đăng nhập không chính xác');
        }
    }

    public function getDangky()
    {
        return view('page.dangky');
    }

    public function postDangky(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required:min:6|max:20',
                're_password'=>'required|same:password'
            ],
            [
                'name.required'=>'Bạn phải nhập họ tên',
                'email.required'=>'Bạn phải nhập email',
                'email.email'=>'Email không đúng định dạng',
                'email.unique'=>'Email đã trùng, vui lòng nhập email khác',
                'password.required'=>'Bạn phải nhập mật khẩu',
                'password.min'=>'Mật khẩu phải chứa ít nhất 6 ký tự',
                'password.max'=>'Mật khẩu chứa tối đa 20 ký tự',
                're_password.required'=>'Bạn phải nhập lại mật khẩu',
                're_password.same'=>'Mật khẩu không trùng khớp'
            ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('dangnhap');
    }

    public function getDangxuat()
    {
        Auth::logout();
        session()->forget('user_login');
        return redirect('trangchu');
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
        $user->password = Hash::make($request->password);
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
            $user->password = Hash::make($request->password);
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
