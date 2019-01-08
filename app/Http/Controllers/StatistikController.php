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
