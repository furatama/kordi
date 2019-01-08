<?php

namespace App\Http\Controllers;

use App\Banjar;
use App\Desa;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class BanjarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mtableref = route('master.banjar.fetch');
        $pdata = Desa::all();
        $data = ['id'=>'','nama'=>'','iddesa'=>''];
        return view('master.index',['reg'=>'banjar','parent'=>'desa','menu'=>'master.banjar'],compact('mtableref','pdata','data'));
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
        $mdata = Banjar::find($data['id']);
        if ($mdata) {
            $mdata->fill($data);
            $mdata->save();
        } else {
            $mdata = Banjar::create($data);
        }

        return redirect()->route('master.banjar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\banjar  $banjar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\banjar  $banjar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Banjar::find($id);
        $mtableref = route('master.banjar.fetch');
        $pdata = Desa::all();
        return view('master.index',['reg'=>'banjar','parent'=>'desa','menu'=>'master.banjar'],compact('data','mtableref','pdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\banjar  $banjar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\banjar  $banjar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mdata = Banjar::findorfail($id);
        $mdata->delete();

        return redirect()->route('master.banjar');
    }

    public function fetch()
      {
          $query = Banjar::with(['desa'])->select('banjar.*');

          return Datatables::of($query)->make(true);
      }

}
