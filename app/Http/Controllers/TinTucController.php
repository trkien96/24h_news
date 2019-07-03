<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\Comment;

class TinTucController extends Controller
{
    //
    public function getDanhSach()
    {
        $tintuc = TinTuc::orderBy('id','asc')->get();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }

    public function getThem()
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
        [
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required'
        ],
        [
            'LoaiTin.required'=>'Bạn chưa chọn loại tin',
            'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
            'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 ký tự',
            'TieuDe.unique'=>'Tiêu đề đã tồn tại',
            'TomTat.required'=>'Bạn chưa nhập tóm tắt',
            'NoiDung.required'=>'Bạn chưa nhập nội dung'
        ]);

        $tintuc = new TinTuc();
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;

        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->idLoaiTin = $request->idLoaiTin;
        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $type_image = $file->getClientOriginalExtension();
            $array_type = ['jpg','png','jpeg','gif'];
            if(!in_array($type_image,$array_type))
            {
                return redirect('admin/tintuc/them')->with('loi','Bạn chỉ dược chọn kiểu file là ảnh');
            }
            $hinh = str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$hinh))
            {
                $hinh = str_random(4)."_".$name;
            }
            $file->move('upload/tintuc',$hinh);
            $tintuc->Hinh = $hinh;
        }
        else
        {
            $tintuc->Hinh = "";
        }
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','Thêm tin thành công');
    }

    public function getSua($id)
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);
        return view('admin.tintuc.sua',['theloai'=>$theloai,'loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }

    public function postSua(Request $request,$id)
    {
        $tintuc = TinTuc::find($id);
        $this->validate($request,
            [
                'LoaiTin'=>'required',
                'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
                'TomTat'=>'required',
                'NoiDung'=>'required'
            ],
            [
                'LoaiTin.required'=>'Bạn chưa chọn loại tin',
                'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
                'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 ký tự',
                'TieuDe.unique'=>'Tiêu đề đã tồn tại',
                'TomTat.required'=>'Bạn chưa nhập tóm tắt',
                'NoiDung.required'=>'Bạn chưa nhập nội dung'
            ]);

        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;

        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->idLoaiTin = $request->LoaiTin;
        if($request->hasFile('Hinh'))
        {
            unlink("upload/tintuc/".$tintuc->Hinh);
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $type_image = $file->getClientOriginalExtension();
            $array_type = ['jpg','png','jpeg','gif'];
            if(!in_array($type_image,$array_type))
            {
                return redirect('admin/tintuc/them')->with('loi','Bạn chỉ dược chọn kiểu file là ảnh');
            }
            $hinh = str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$hinh))
            {
                $hinh = str_random(4)."_".$name;
            }

            $file->move('upload/tintuc',$hinh);
            $tintuc->Hinh = $hinh;
        }
        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$tintuc->id)->with('thongbao','Sửa tin thành công');
    }

    public function getXoa($id)
    {
        $tintuc = TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach');
    }
}
