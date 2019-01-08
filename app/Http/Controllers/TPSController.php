<?php

namespace App\Http\Controllers;

use App\TPS;
use App\Banjar;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class TPSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mtableref = route('master.tps.fetch');
        $pdata = Banjar::all();
        $data = ['id'=>'','nama'=>'','idbanjar'=>''];
        return view('master.index',['reg'=>'tps','parent'=>'banjar','menu'=>'master.tps'],compact('mtableref','pdata','data'));
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
        $mdata = TPS::find($data['id']);
        if ($mdata) {
            $mdata->fill($data);
            $mdata->save();
        } else {
            $mdata = TPS::create($data);
        }

        return redirect()->route('master.tps');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tps  $tps
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tps  $tps
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = TPS::find($id);
        $mtableref = route('master.tps.fetch');
        $pdata = Banjar::all();
        return view('master.index',['reg'=>'tps','parent'=>'banjar','menu'=>'master.tps'],compact('data','mtableref','pdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tps  $tps
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tps  $tps
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mdata = TPS::findorfail($id);
        $mdata->delete();

        return redirect()->route('master.tps');
    }

    public function fetch()
      {
          $query = TPS::with(['banjar'])->select('tps.*');

          return Datatables::of($query)->make(true);
      }

}
