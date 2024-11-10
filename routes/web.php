<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('trangchu');
});

Route::get('/sanphan', function () {
    return view('sanphan');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/logout', function () {
    return view('logout');
});
Route::get('/dangky', 'AuthController@showRegistrationForm')->name('dangky');
Route::post('/dangky', 'AuthController@register');
Route::get('/dangnhap', function () {
    return view('dangnhap');
});
Route::get('/vonglung', function () {
    return view('vonglung');
});
Route::get('/vitamin', function () {
    return view('vitamin');
});
Route::get('/diung', function () {
    return view('diung');
});
Route::get('/dondang', function () {
    return view('dondang');
});
Route::get('/giohang', function () {
    return view('giohang');
});
Route::get('/khangchat', function () {
    return view('khangchat');
});
Route::get('/sanphamchitiet', function () {
    return view('sanphamchitiet');
});
Route::get('/lienhe', function () {
    return view('lienhe');
});
Route::get('/mevabe', function () {
    return view('mevabe');
});
Route::get('/muahang', function () {
    return view('muahang');
});
Route::get('/suimaoga', function () {
    return view('suimaoga');
});
Route::get('/thongtinkhachhang', function () {
    return view('thongtinkhachhang');
});
Route::get('/thucphamboxung', function () {
    return view('thucphamboxung');
});
Route::get('/timkiem', function () {
    return view('timkiem');
});
Route::get('/thongtinkhachhangchitiet', function () {
    return view('thongtinkhachhangchitiet');
});