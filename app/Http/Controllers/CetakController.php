<?php

namespace App\Http\Controllers;

use App;
use DB;
use PDF;

class CetakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

		private function assemble($data) {
			// $kontak = json_decode($data['kontak']);
			// $data['nohp'] = '';
			// foreach ($kontak as $k) {
			// 	if ($k['tipe'] == 'telp' && $k['kontak'] != null) {
			// 		$data['nohp'] = $k['kontak'];
			// 		break;
			// 	}
			// }
    	$data['subjudul'] = "Per " . date('d/m/Y');
			$pdf = PDF::loadView($data['file'],compact('data'));
			return $pdf->stream();
		}

    public function perform($from, $source = null, $id = null) {

    	$data = [];

    	if ($from == 'koorl1') {

    		if ($source == null) {
    			$data['judul'] = "Data Seluruh Koordinator Utama";
    			$data['data'] = App\KoorL1::all();
    			$data['title'] = "Koordinator Utama";
    			$data['file'] = 'pdf.cetak';
    		}

    	}

    	if ($from == 'koorl2') {

    		if ($source == null) {
    			$data['judul'] = "Data Seluruh Asisten";
    			$data['data'] = App\KoorL2::orderBy('idl1','ASC')->get();
    			$data['title'] = "Asisten";
    			$data['file'] = 'pdf.cetak-2';
    		} elseif ($source == 'koorl1') {
    			$data['judul'] = "Data Asisten";
    			$data['iddata'] = App\KoorL1::where('id','=',$id)->first();
    			$data['subjudul2'] = "Koordinator Utama : " . $data['iddata']->namalengkap;
    			// print_r($data['iddata']);
    			// die($data['subjudul']);
    			$data['data'] = App\KoorL2::where('idl1','=',$id)->get();
    			$data['title'] = "Asisten";
    			$data['file'] = 'pdf.cetak';
    		}
    		
    	}

    	if ($from == 'pemilih') {

    		if ($source == null) {
    			$data['judul'] = "Data Seluruh Pemilih";
    			// $data['data'] = App\Pemilih::all();
    			$data['data'] = DB::table('pemilih')
    														->join('banjar','pemilih.idbanjar','=','banjar.id')
    														->join('desa','pemilih.iddesa','=','desa.id')
    														->join('tps','pemilih.idtps','=','tps.id')
    														->join('koorl2','pemilih.idl2','=','koorl2.id')
    														->join('koorl1','koorl2.idl1','=','koorl1.id')
    														->select(	'koorl1.id as idl1', 'koorl1.namalengkap as namal1',
    																			'koorl2.id as idl2', 'koorl2.namalengkap as namal2',
    																			'pemilih.nik',
    																			'pemilih.namalengkap', 
    																			'pemilih.jeniskelamin', 
    																			'banjar.nama as banjar', 
    																			'tps.nama as tps', 
    																			'desa.nama as desa',
    																			'pemilih.kontak')
    														->orderBy('idl1')
    														->orderBy('idl2')
    														// ->take(100)
    														->get();
    			$data['title'] = "Pemilih";
    			$data['file'] = 'pdf.cetak-3';
    		} elseif ($source == 'koorl2') {
    			$data['judul'] = "Data Pemilih";
    			$data['iddata'] = App\KoorL2::where('id','=',$id)->first();
    			$data['subjudul2'] = "Asisten : " . $data['iddata']->namalengkap;
    			$data['data'] = App\Pemilih::where('idl2','=',$id)->get();
    			$data['title'] = "Asisten";
    			$data['file'] = 'pdf.cetak';
    		} elseif ($source == 'koorl1') {
    			$data['judul'] = "Data Pemilih";
    			$data['iddata'] = App\KoorL1::where('id','=',$id)->first();
    			$data['subjudul2'] = "Koordinator Utama : " . $data['iddata']->namalengkap;
    			$data['data'] = DB::table('pemilih')
    														->join('banjar','pemilih.idbanjar','=','banjar.id')
    														->join('desa','pemilih.iddesa','=','desa.id')
    														->join('tps','pemilih.idtps','=','tps.id')
    														->join('koorl2','pemilih.idl2','=','koorl2.id')
    														->join('koorl1','koorl2.idl1','=','koorl1.id')
    														->where('koorl1.id','=',$id)
    														->select(	'koorl1.id as idl1', 'koorl1.namalengkap as namal1',
    																			'koorl2.id as idl2', 'koorl2.namalengkap as namal2',
    																			'pemilih.nik',
    																			'pemilih.namalengkap', 
    																			'pemilih.jeniskelamin', 
    																			'banjar.nama as banjar', 
    																			'tps.nama as tps', 
    																			'desa.nama as desa',
    																			'pemilih.kontak')
    														->orderBy('idl1')
    														->orderBy('idl2')
    														// ->take(100)
    														->get();
    			$data['title'] = "Pemilih";
    			$data['file'] = 'pdf.cetak-2b';
    		}
    		
    	}

    	$data['source'] = $source;
    	return CetakController::assemble($data);
    }
}
