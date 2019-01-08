<?php

namespace App\Http\Controllers;

use App\Desa;
use App\Kecamatan;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mtableref = route('master.desa.fetch');
        $pdata = Kecamatan::all();
        $data = ['id'=>'','nama'=>'','idkecamatan'=>''];
        return view('master.index',['reg'=>'desa','parent'=>'kecamatan','menu'=>'master.desa'],compact('mtableref','pdata','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $data = $request->all();
        $mdata = Desa::find($data['id']);
        if ($mdata) {
            $mdata->fill($data);
            $mdata->save();
        } else {
            $mdata = Desa::create($data);
        }

        return redirect()->route('master.desa');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Desa::find($id);
        $mtableref = route('master.desa.fetch');
        $pdata = Kecamatan::all();
        return view('master.index',['reg'=>'desa','parent'=>'kecamatan','menu'=>'master.desa'],compact('data','mtableref','pdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mdata = Desa::findorfail($id);
        $mdata->delete();

        return redirect()->route('master.desa');
    }

    public function fetch()
      {
          $query = Desa::with(['kecamatan'])->select('desa.*');

          return Datatables::of($query)->make(true);
      }

}
