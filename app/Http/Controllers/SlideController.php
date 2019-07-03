<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    //
    public function getDanhSach()
    {
        $slide = Slide::all();
        return view('admin.slide.danhsach',['slide'=>$slide]);
    }

    public function getThem()
    {
        return view('admin.slide.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
        [
            'Ten'=>'required',
            'NoiDung'=>'required'
        ],
        [
            'Ten.required'=>'Bạn chưa nhập tên slide',
            'NoiDung.required'=>'Bạn chưa nhập nội dung slide'
        ]);
        $slide = new Slide();
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link'))
        {
            $slide->link = $request->link;
        }

        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $type_image = $file->getClientOriginalExtension();
            $array_type = ['jpg','png','jpeg','gif'];
            if(!in_array($type_image,$array_type))
            {
                return redirect('admin/slide/them')->with('loi','Bạn chỉ dược chọn kiểu file là ảnh');
            }
            $hinh = str_random(4)."_".$name;
            while(file_exists("upload/slide/".$hinh))
            {
                $hinh = str_random(4)."_".$name;
            }
            $file->move('upload/slide',$hinh);
            $slide->Hinh = $hinh;
        }
        else
        {
            $slide->Hinh = "";
        }
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','Thêm slide thành công');
    }

    public function getSua($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide.sua',['slide'=>$slide]);
    }

    public function postSua(Request $request,$id)
    {
        $this->validate($request,
            [
                'Ten'=>'required',
                'NoiDung'=>'required'
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên slide',
                'NoiDung.required'=>'Bạn chưa nhập nội dung slide'
            ]);
        $slide = Slide::find($id);
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link'))
        {
            $slide->link = $request->link;
        }

        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $type_image = $file->getClientOriginalExtension();
            $array_type = ['jpg','png','jpeg','gif'];
            if(!in_array($type_image,$array_type))
            {
                return redirect('admin/slide/sua/'.$id)->with('loi','Bạn chỉ dược chọn kiểu file là ảnh');
            }
            $hinh = str_random(4)."_".$name;
            while(file_exists("upload/slide/".$hinh))
            {
                $hinh = str_random(4)."_".$name;
            }
            unlink('upload/slide/'.$slide->Hinh);
            $file->move('upload/slide',$hinh);
            $slide->Hinh = $hinh;
        }
        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa slide thành công');
    }
}
