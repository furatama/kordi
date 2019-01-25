<?php

namespace App\Http\Controllers;

use Auth;
// use App\Pemilih;
use App\KoorL1;
use App\KoorL2;
use App\Desa;
use App\Banjar;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use DB;

class StatistikController extends Controller
{
  
  public function __construct()
  {
      $this->middleware('auth');
  }

	public function index() {
		if (!Auth::user()->hasAccess('SDR'))
      return redirect('/');
		$mtableref = route('stats.kecamatan.fetch');
		$reg = 'desa';
		return view('stats.index',compact('mtableref','reg'));
	}

	public function desa() {
		if (!Auth::user()->hasAccess('SBR'))
      return redirect('/');
		$mtableref = route('stats.desa.fetch');
		$reg = 'banjar';
		return view('stats.index',compact('mtableref','reg'));
	}

	public function harian() {
		if (!Auth::user()->hasAccess('SBR'))
      return redirect('/');
		$mtableref = route('stats.harian.fetch');
		$reg = 'harian';
		return view('stats.index',compact('mtableref','reg'));
	}

	public function koorl1() {
		if (!Auth::user()->hasAccess('SBR'))
      return redirect('/');
		$mtableref = route('stats.koorl1.fetch');
		$reg = 'koorl1';
		return view('stats.koorl1',compact('mtableref','reg'));
	}

	public function koorl2() {
		if (!Auth::user()->hasAccess('SBR'))
      return redirect('/');
		$mtableref = route('stats.koorl2.fetch');
		$reg = 'koorl2';
		return view('stats.koorl2',compact('mtableref','reg'));
	}

	public function desaID($id) {
		if (!Auth::user()->hasAccess('SBR'))
      return redirect('/');
		$mtableref = route('stats.desa.id.fetch',$id);
		$reg = 'banjar';
		return view('stats.index',compact('mtableref','reg'));
	}

	public function fetch()
  {
      $query = DB::select("SELECT desa.id,desa.nama,l1n,l2n,pn FROM desa 
													LEFT JOIN (SELECT iddesa,COUNT(*) as l1n FROM koorl1 GROUP BY iddesa) l1 
													ON l1.iddesa = desa.id
													LEFT JOIN (SELECT iddesa,COUNT(*) as l2n FROM koorl2 GROUP BY iddesa) l2 
													ON l2.iddesa = desa.id 
													LEFT JOIN (SELECT iddesa,COUNT(*) as pn FROM pemilih GROUP BY iddesa) p 
													ON p.iddesa = desa.id 
													GROUP BY desa.id");

      return Datatables::of($query)->make(true);
  }

  public function fetchL1()
  {
      $query = DB::select("SELECT koorl1.id,koorl1.namalengkap,l2n,SUM(pn) as pn,l2n+SUM(pn) as total FROM koorl1
													LEFT JOIN (SELECT idl1,COUNT(*) as l2n FROM koorl2 GROUP BY idl1) l2 
													ON l2.idl1 = koorl1.id
													LEFT JOIN (SELECT koorl2.id,koorl2.idl1,pn FROM koorl2
														LEFT JOIN (SELECT idl2,COUNT(*) as pn FROM pemilih GROUP BY idl2) p 
														ON p.idl2 = koorl2.id 
														GROUP BY koorl2.id) px
													ON px.idl1 = koorl1.id
													GROUP BY koorl1.id");

      return Datatables::of($query)->make(true);
  }

  public function fetchL2()
  {
      $query = DB::select("SELECT koorl2.id,koorl2.namalengkap,pn FROM koorl2
														LEFT JOIN (SELECT idl2,COUNT(*) as pn FROM pemilih GROUP BY idl2) p 
														ON p.idl2 = koorl2.id 
														GROUP BY koorl2.id");

      return Datatables::of($query)->make(true);
  }

  public function fetchDesa()
  {
      $query = DB::select("SELECT banjar.id,banjar.nama,l1n,l2n,pn FROM banjar 
													LEFT JOIN (SELECT idbanjar,COUNT(*) as l1n FROM koorl1 GROUP BY idbanjar) l1 
													ON l1.idbanjar = banjar.id
													LEFT JOIN (SELECT idbanjar,COUNT(*) as l2n FROM koorl2 GROUP BY idbanjar) l2 
													ON l2.idbanjar = banjar.id 
													LEFT JOIN (SELECT idbanjar,COUNT(*) as pn FROM pemilih GROUP BY idbanjar) p 
													ON p.idbanjar = banjar.id 
													GROUP BY banjar.id");

      return Datatables::of($query)->make(true);
  }

  public function fetchHarian()
  {
       $query = DB::select("SELECT tgl as nama, SUM(l1n) as l1n, SUM(l2n) as l2n, SUM(pn) as pn FROM (SELECT date(created_at) as tgl, count(*)  as l1n, 0 as l2n, 0 as pn from koorl1 GROUP by date(created_at)
					union all
					SELECT date(created_at) as tgl, 0 as l1n, count(*) as l2n, 0 as pn from koorl2 GROUP by date(created_at)
					union all
					SELECT date(created_at) as tgl, 0 as l1n, 0 as l2n, count(*) as pn from pemilih GROUP by date(created_at)) unity 
					GROUP by tgl");
      // dd($query);

      return Datatables::of($query)->make(true);
  }

  public function fetchDesaID($id)
  {
      $query = DB::select("SELECT banjar.id,banjar.nama,l1n,l2n,pn FROM banjar 
													LEFT JOIN (SELECT idbanjar,COUNT(*) as l1n FROM koorl1 GROUP BY idbanjar) l1 
													ON l1.idbanjar = banjar.id
													LEFT JOIN (SELECT idbanjar,COUNT(*) as l2n FROM koorl2 GROUP BY idbanjar) l2 
													ON l2.idbanjar = banjar.id 
													LEFT JOIN (SELECT idbanjar,COUNT(*) as pn FROM pemilih GROUP BY idbanjar) p 
													ON p.idbanjar = banjar.id 
													WHERE banjar.iddesa = '$id'
													GROUP BY banjar.id");

      return Datatables::of($query)->make(true);
  }

}
