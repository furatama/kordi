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

Auth::routes();

Route::get('/', function () {
  return view('welcome');
})->name('index-page')->middleware('auth');


Route::get('koorl1/fetch', [
	'as'=>'koorl1.fetch',
	'uses'=>'KoorL1Controller@fetch'
]);
Route::get('koorl1/desa/{iddesa}', 'KoorL1Controller@showByDesa')->name('koorl1.desa');
Route::get('koorl1/desa/{iddesa}/fetch', 'KoorL1Controller@fetchForDesa')->name('koorl1.desa.fetch');
Route::get('koorl1/banjar/{idbanjar}', 'KoorL1Controller@showByBanjar')->name('koorl1.banjar');
Route::get('koorl1/banjar/{idbanjar}/fetch', 'KoorL1Controller@fetchForBanjar')->name('koorl1.banjar.fetch');
Route::get('koorl1/report/{by}/{id}', 'KoorL1Controller@report')->name('koorl1.report');
Route::resource('koorl1','KoorL1Controller');

Route::get('koorl2/fetch', [
	'as'=>'koorl2.fetch',
	'uses'=>'KoorL2Controller@fetch'
]);
Route::get('koorl2/create/{id}', 'KoorL2Controller@create');
Route::get('koorl2/koorl1/{id}', 'KoorL2Controller@showForL1')->name('koorl1.pemilih');
Route::get('koorl2/koorl1/{id}/fetch', [
	'as'=>'koorl2.fetchForL1',
	'uses'=>'KoorL2Controller@fetchForL1'
]);
Route::get('koorl2/desa/{iddesa}', 'KoorL2Controller@showByDesa')->name('koorl2.desa');
Route::get('koorl2/desa/{iddesa}/fetch', 'KoorL2Controller@fetchForDesa')->name('koorl2.desa.fetch');
Route::get('koorl2/banjar/{idbanjar}', 'KoorL2Controller@showByBanjar')->name('koorl2.banjar');
Route::get('koorl2/banjar/{idbanjar}/fetch', 'KoorL2Controller@fetchForBanjar')->name('koorl2.banjar.fetch');
Route::get('koorl2/report/{by}/{id}', 'KoorL2Controller@report')->name('koorl2.report');
Route::resource('koorl2','KoorL2Controller');

Route::get('pemilih/fetch', [
	'as'=>'pemilih.fetch',
	'uses'=>'PemilihController@fetch',
]);
Route::get('pemilih/create/{id}', 'PemilihController@create');
Route::get('pemilih/koorl1/{id}', 'PemilihController@showForL1')->name('koorl1.pemilih');
Route::get('pemilih/koorl1/{id}/fetch', [
	'as'=>'pemilih.fetchForL1',
	'uses'=>'PemilihController@fetchForL1'
]);
Route::get('pemilih/koorl2/{id}', 'PemilihController@showForL2')->name('koorl2.pemilih');
Route::get('pemilih/koorl2/{id}/fetch', [
	'as'=>'pemilih.fetchForL2',
	'uses'=>'PemilihController@fetchForL2'
]);
Route::get('pemilih/desa/{iddesa}', 'PemilihController@showByDesa')->name('pemilih.desa');
Route::get('pemilih/desa/{iddesa}/fetch', 'PemilihController@fetchForDesa')->name('pemilih.desa.fetch');
Route::get('pemilih/banjar/{idbanjar}', 'PemilihController@showByBanjar')->name('pemilih.banjar');
Route::get('pemilih/banjar/{idbanjar}/fetch', 'PemilihController@fetchForBanjar')->name('pemilih.banjar.fetch');
Route::get('pemilih/report/{by}/{id}', 'PemilihController@report')->name('pemilih.report');
Route::resource('pemilih','PemilihController');

Route::get('relawan/fetch', [
	'as'=>'relawan.fetch',
	'uses'=>'RelawanController@fetch'
]);
Route::get('relawan/desa/{iddesa}', 'RelawanController@showByDesa')->name('relawan.desa');
Route::get('relawan/desa/{iddesa}/fetch', 'RelawanController@fetchForDesa')->name('relawan.desa.fetch');
Route::get('relawan/banjar/{idbanjar}', 'RelawanController@showByBanjar')->name('relawan.banjar');
Route::get('relawan/banjar/{idbanjar}/fetch', 'RelawanController@fetchForBanjar')->name('relawan.banjar.fetch');
Route::get('relawan/report/{by}/{id}', 'RelawanController@report')->name('relawan.report');
Route::resource('relawan','RelawanController');

Route::get('cetak/{from}/{source}/{id}','CetakController@perform')->name('cetak.detail');
Route::get('cetak/{from}','CetakController@perform')->name('cetak');

Route::get('stats','StatistikController@index')->name('stats.kecamatan');
Route::get('stats/desa','StatistikController@desa')->name('stats.desa');
Route::get('stats/desa/{id}','StatistikController@desaID')->name('stats.desa.id');

Route::get('stats/fetch','StatistikController@fetch')->name('stats.kecamatan.fetch');
Route::get('stats/fetch/desa','StatistikController@fetchDesa')->name('stats.desa.fetch');
Route::get('stats/fetch/desa/{id}','StatistikController@fetchDesaID')->name('stats.desa.id.fetch');

Route::get('master/user','UserController@index')->name('master.user')->middleware('auth');
Route::get('master/desa','DesaController@index')->name('master.desa')->middleware('auth');
Route::get('master/banjar','BanjarController@index')->name('master.banjar')->middleware('auth');
Route::get('master/tps','TPSController@index')->name('master.tps')->middleware('auth');

Route::post('master/user','UserController@store')->name('master.user.submit')->middleware('auth');
Route::post('master/desa','DesaController@store')->name('master.desa.submit')->middleware('auth');
Route::post('master/banjar','BanjarController@store')->name('master.banjar.submit')->middleware('auth');
Route::post('master/tps','TPSController@store')->name('master.tps.submit')->middleware('auth');

Route::get('master/user/{id}/edit','UserController@edit')->name('master.user.edit')->middleware('auth');
Route::get('master/desa/{id}/edit','DesaController@edit')->name('master.desa.edit')->middleware('auth');
Route::get('master/banjar/{id}/edit','BanjarController@edit')->name('master.banjar.edit')->middleware('auth');
Route::get('master/tps/{id}/edit','TPSController@edit')->name('master.tps.edit')->middleware('auth');

Route::delete('master/user/{id}','UserController@destroy')->name('master.user.destroy')->middleware('auth');
Route::delete('master/desa/{id}','DesaController@destroy')->name('master.desa.destroy')->middleware('auth');
Route::delete('master/banjar/{id}','BanjarController@destroy')->name('master.banjar.destroy')->middleware('auth');
Route::delete('master/tps/{id}','TPSController@destroy')->name('master.tps.destroy')->middleware('auth');

Route::get('master/user/fetch','UserController@fetch')->name('master.user.fetch')->middleware('auth');
Route::get('master/desa/fetch','DesaController@fetch')->name('master.desa.fetch')->middleware('auth');
Route::get('master/banjar/fetch','BanjarController@fetch')->name('master.banjar.fetch')->middleware('auth');
Route::get('master/tps/fetch','TPSController@fetch')->name('master.tps.fetch')->middleware('auth');

// Route::get('login', 'SigninController@form')->name('login');
// Route::get('logout', 'SigninController@out')->name('logout');
// Route::post('login/attempt', 'SigninController@attempt')->name('login.attempt');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('changepass', 'UserController@changepw_show')->name('changepw.show');
Route::patch('changepass/{id}', 'UserController@changepw')->name('changepw');
