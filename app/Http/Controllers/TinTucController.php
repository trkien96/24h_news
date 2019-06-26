<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;

class TinTucController extends Controller
{
    //
    public function getDanhSach()
    {
        $tintuc = TinTuc::orderBy('id','asc')->get();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }

    public function getSua()
    {
        return view('admin.tintuc.sua');
    }

    public function getThem()
    {
        return view('admin.tintuc.them');
    }
}
