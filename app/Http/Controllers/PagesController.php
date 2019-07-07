<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\Slide;

class PagesController extends Controller
{
    //
    function  __construct()
    {
        $theloai = TheLoai::all();
        $slide = Slide::all();
        View::share('theloai',$theloai);
        View::share('slide',$slide);
    }

    function trangchu()
    {
        return view('page.trangchu');
    }

    function lienhe()
    {
        return view('page.lienhe');
    }

    function loaitin($id)
    {
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view('page.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }

    function tintuc($id)
    {
        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(5)->get();
        return view('page.chitiet',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }
}