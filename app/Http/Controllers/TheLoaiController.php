<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Input, Redirect;
use App\TheLoai;

class TheLoaiController extends Controller
{
    //
    public function getDanhSach()
    {
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }

    public function getThem()
    {
        return view('admin.theloai.them');
    }

    public function postThem(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'TenTL' => 'required|unique:TheLoai,Ten|min:3|max:100'
        ],[
            'TenTL.required' => 'Bạn phải nhập tên thể loại',
            'TenTL.unique' => 'Tên thể loại đã tồn tại',
            'TenTL.min' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',
            'TenTL.max' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $theloai = new TheLoai();
        $theloai->Ten = $request->TenTL;
        $theloai->TenKhongDau = changeTitle($request->TenTL);
        $theloai->save();
        return back()->with('thongbao','Thêm thể loại thành công');
    }

    public function getSua($id)
    {
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }

    public function postSua(Request $request,$id)
    {
        $theloai = TheLoai::find($id);
        $this->validate($request,
        [
            'TenTL' => 'required|unique:TheLoai,Ten|min:3|max:100'
        ],
        [
            'TenTL.required' => 'Bạn phải nhập tên thể loại',
            'TenTL.unique' => 'Tên thể loại đã tồn tại',
            'TenTL.min' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',
            'TenTL.max' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',
        ]);
        $theloai->Ten = $request->TenTL;
        $theloai->TenKhongDau = changeTitle($request->TenTL);
        $theloai->save();
        return back()->with('thongbao','Sửa thể loại thành công');
    }

    public function getXoa($id)
    {
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach');
    }
}
