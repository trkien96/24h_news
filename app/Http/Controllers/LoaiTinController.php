<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach()
    {
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }

    public function getThem()
    {
        $theloai = TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }

    public function postThem(Request $request)
    {
        $this->validate($request,[
            'TenLT' => 'required|unique:LoaiTin,Ten|min:3|max:100'
        ],[
            'TenLT.required' => 'Bạn phải nhập tên loại tin',
            'TenLT.unique' => 'Tên loại tin đã tồn tại',
            'TenLT.min' => 'Tên loại tin có độ dài từ 3 đến 100 ký tự',
            'TenLT.max' => 'Tên loại tin có độ dài từ 3 đến 100 ký tự',
        ]);
        $loaitin = new LoaiTin();
        $loaitin->idTheLoai = $request->idTL;
        $loaitin->Ten = $request->TenLT;
        $loaitin->TenKhongDau = changeTitle($request->TenLT);
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Thêm loại tin thành công');
    }

    public function getSua($id)
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.sua',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postSua(Request $request, $id)
    {
        $loaitin = LoaiTin::find($id);
        $this->validate($request,
            [
                'TenLT' => 'required|min:3|max:100'
            ],
            [
                'TenLT.required' => 'Bạn phải nhập tên loại tin',
                'TenLT.min' => 'Tên loại tin có độ dài từ 3 đến 100 ký tự',
                'TenLT.max' => 'Tên loại tin có độ dài từ 3 đến 100 ký tự',
            ]);
        $loaitin->idTheLoai = $request->idTL;
        $loaitin->Ten = $request->TenLT;
        $loaitin->TenKhongDau = changeTitle($request->TenLT);
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sửa loại tin thành công');
    }

    public function getXoa($id)
    {
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach');
    }
}
