<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Phần admin

Route::get('dangnhap','UserController@getDangnhap');
Route::post('dangnhap','UserController@postDangnhap');
Route::get('dangky','UserController@getDangky');
Route::post('dangky','UserController@postDangky');
Route::get('dangxuat','UserController@getDangxuat');

Route::group(['prefix' => 'admin','middleware'=>'adminLogin'], function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::group(['prefix' => 'theloai'], function () {
        Route::get('danhsach','TheLoaiController@getDanhSach');
        Route::get('them','TheLoaiController@getThem');
        Route::post('them','TheLoaiController@postThem');
        Route::get('sua/{id}','TheLoaiController@getSua');
        Route::post('sua/{id}','TheLoaiController@postSua');
        Route::get('xoa/{id}','TheLoaiController@getXoa');
    });
    Route::group(['prefix' => 'loaitin'], function () {
        Route::get('danhsach','LoaiTinController@getDanhSach');
        Route::get('them','LoaiTinController@getThem');
        Route::post('them','LoaiTinController@postThem');
        Route::get('sua/{id}','LoaiTinController@getSua');
        Route::post('sua/{id}','LoaiTinController@postSua');
        Route::get('xoa/{id}','LoaiTinController@getXoa');
    });
    Route::group(['prefix' => 'tintuc'], function () {
        Route::get('danhsach','TinTucController@getDanhSach');
        Route::get('them','TinTucController@getThem');
        Route::post('them','TinTucController@postThem');
        Route::get('sua/{id}','TinTucController@getSua');
        Route::post('sua/{id}','TinTucController@postSua');
        Route::get('xoa/{id}','TinTucController@getXoa');
    });
    Route::group(['prefix' => 'comment'], function () {
        Route::get('xoa/{id}/{idTinTuc}','CommentController@getXoa');
    });
    Route::group(['prefix' => 'slide'], function () {
        Route::get('danhsach','SlideController@getDanhSach');
        Route::get('them','SlideController@getThem');
        Route::post('them','SlideController@postThem');
        Route::get('sua/{id}','SlideController@getSua');
        Route::post('sua/{id}','SlideController@postSua');
        Route::get('xoa/{id}','SlideController@getXoa');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('danhsach','UserController@getDanhSach');
        Route::get('them','UserController@getThem');
        Route::post('them','UserController@postThem');
        Route::get('sua/{id}','UserController@getSua');
        Route::post('sua/{id}','UserController@postSua');
        Route::get('xoa/{id}','UserController@getXoa');
    });
    Route::group(['prefix' => 'ajax'], function () {
        Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
    });
});
Auth::routes();

//Phần trang chính

Route::get('/',function (){
    return redirect()->route('trangchu');
});
Route::get('trangchu','PagesController@trangchu')->name('trangchu');
Route::get('loaitin/{id}/{TenKhongDau}.html','PagesController@loaitin');
Route::get('chitiet/{id}/{TieuDeKhongDau}.html','PagesController@tintuc');
Route::get('lienhe','PagesController@lienhe');
Route::get('gioithieu','PagesController@gioithieu');
Route::get('taikhoan','PagesController@taikhoan');
