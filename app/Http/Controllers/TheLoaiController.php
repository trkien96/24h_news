<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    //
    public function getDanhSach()
    {
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }

    public function getSua()
    {
        return view('admin.theloai.sua');
    }

    public function getThem()
    {
        return view('admin.theloai.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request,[
            'TenTL' => 'required|min:3|max:100'
        ],[
            'TenTL.required' => 'Bạn phải nhập tên thể loại',
            'TenTL.min' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',
            'TenTL.max' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',
        ]);

        $theloai = new TheLoai();
        $theloai->Ten = $request->TenTL;
        $theloai->TenKhongDau = changeTitle($request->TenTL);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Thêm thể loại thành công');
    }
}
