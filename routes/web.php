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

Route::get('keybanjar/fetch', [
	'as'=>'keybanjar.fetch',
	'uses'=>'KeyBanjarController@fetch'
]);
Route::get('keybanjar/desa/{iddesa}', 'KeyBanjarController@showByDesa')->name('keybanjar.desa');
Route::get('keybanjar/desa/{iddesa}/fetch', 'KeyBanjarController@fetchForDesa')->name('keybanjar.desa.fetch');
Route::get('keybanjar/banjar/{idbanjar}', 'KeyBanjarController@showByBanjar')->name('keybanjar.banjar');
Route::get('keybanjar/banjar/{idbanjar}/fetch', 'KeyBanjarController@fetchForBanjar')->name('keybanjar.banjar.fetch');
Route::get('keybanjar/report/{by}/{id}', 'KeyBanjarController@report')->name('keybanjar.report');
Route::resource('keybanjar','KeyBanjarController');

Route::get('keykomunitas/fetch', [
	'as'=>'keykomunitas.fetch',
	'uses'=>'KeyKomunitasController@fetch'
]);
Route::get('keykomunitas/desa/{iddesa}', 'KeyKomunitasController@showByDesa')->name('keykomunitas.desa');
Route::get('keykomunitas/desa/{iddesa}/fetch', 'KeyKomunitasController@fetchForDesa')->name('keykomunitas.desa.fetch');
Route::get('keykomunitas/banjar/{idbanjar}', 'KeyKomunitasController@showByBanjar')->name('keykomunitas.banjar');
Route::get('keykomunitas/banjar/{idbanjar}/fetch', 'KeyKomunitasController@fetchForBanjar')->name('keykomunitas.banjar.fetch');
Route::get('keykomunitas/report/{by}/{id}', 'KeyKomunitasController@report')->name('keykomunitas.report');
Route::resource('keykomunitas','KeyKomunitasController');

Route::get('suara/fetch', [
	'as'=>'suara.fetch',
	'uses'=>'SuaraController@fetch'
]);
Route::get('suara/desa/{iddesa}', 'SuaraController@showByDesa')->name('suara.desa');
Route::get('suara/desa/{iddesa}/fetch', 'SuaraController@fetchForDesa')->name('suara.desa.fetch');
Route::get('suara/banjar/{idbanjar}', 'SuaraController@showByBanjar')->name('suara.banjar');
Route::get('suara/banjar/{idbanjar}/fetch', 'SuaraController@fetchForBanjar')->name('suara.banjar.fetch');
Route::get('suara/report/{by}/{id}', 'SuaraController@report')->name('suara.report');
Route::resource('suara','SuaraController');

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

Route::get('master/partai/fetch','PartaiController@fetch')->name('master.partai.fetch')->middleware('auth');
Route::resource('master/partai','PartaiController',[
	'names' => [
		'index' => 'master.partai.index',
		'create' => 'master.partai.create',
		'store' => 'master.partai.store',
		'edit' => 'master.partai.edit',
		'update' => 'master.partai.update',
		'delete' => 'master.partai.delete',
	]
]);

Route::get('master/caleg/fetch','CalegController@fetch')->name('master.caleg.fetch')->middleware('auth');
Route::resource('master/caleg','CalegController',[
	'names' => [
		'index' => 'master.caleg.index',
		'create' => 'master.caleg.create',
		'store' => 'master.caleg.store',
		'edit' => 'master.caleg.edit',
		'update' => 'master.caleg.update',
		'delete' => 'master.caleg.delete',
	]
]);

// Route::get('login', 'SigninController@form')->name('login');
// Route::get('logout', 'SigninController@out')->name('logout');
// Route::post('login/attempt', 'SigninController@attempt')->name('login.attempt');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('changepass', 'UserController@changepw_show')->name('changepw.show');
Route::patch('changepass/{id}', 'UserController@changepw')->name('changepw');
