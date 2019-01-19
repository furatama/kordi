<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Caleg;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use App\FormCaleg;
use Illuminate\Validation\Rule;

class CalegController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('caleg.index',['by'=>'all','id'=>'all']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('L1C'))
            return redirect('caleg');
        $mdata = [];
        $form = $formBuilder->create(FormCaleg::class, [
            'method' => 'POST',
            'model' => $mdata,
            'url' => route('caleg.store'),
        ]);

        return view('caleg.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $formBuilder)
    {

        $form = $formBuilder->create(FormCaleg::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->validate($request, [
            'nama' => 'required',
        ], [
            'nik.required' => 'NIK masih kosong.',
            'nik.max' => 'NIK harus 16 digit.',
            'nik.min' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah dipakai.',
            'nama.required' => 'Nama masih kosong.',
        ]);

        $data = $request->all();
        $mdata = Caleg::create($data);

        return redirect()->route('caleg.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function show(Caleg $caleg)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('L1U'))
            return redirect('caleg');
        $mdata = Caleg::find($id);
        $kontak = json_decode($mdata['kontak'],true);
        $mdata['kontak'] = $kontak;
        $form = $formBuilder->create(FormCaleg::class, [
            'method' => 'PATCH',
            'model' => $mdata,
            'url' => route('caleg.update',$id),
        ]);

        return view('caleg.create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(FormCaleg::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->validate($request, [
            'nama' => 'required',
        ], [
            'nik.required' => 'NIK masih kosong.',
            'nik.max' => 'NIK harus 16 digit.',
            'nik.min' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah dipakai.',
            'nama.required' => 'Nama masih kosong.',
        ]);

        $data = $request->all();
        $mdata = Caleg::findorfail($id);
        $mdata->fill($data);
        $mdata->save();

        return redirect()->route('caleg.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasAccess('L1D'))
            return redirect('caleg');
        // echo "destroy";
        $mdata = Caleg::findorfail($id);
        $mdata->delete();

        return redirect()->route('caleg.index');
    }

    public function fetch()
    {
        $query = Caleg::select('caleg.*');

        return Datatables::of($query)->make(true);
    }

    public function showByDesa($id)
    {
     
        $mtableref = route('caleg.desa.fetch',$id);
        // die($mtableref);
        $reg = \App\Desa::where('id',$id)->first();
        $by = 'desa';
        return view('caleg.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForDesa($id)
    {
        $query = Caleg::select('caleg.*')->where('caleg.iddesa','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function showByBanjar($id)
    {
     
        $mtableref = route('caleg.banjar.fetch',$id);
        // die($mtableref);
        $reg = \App\Banjar::where('id',$id)->first();
        $by = 'banjar';
        return view('caleg.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForBanjar($id)
    {
        $query = Caleg::select('caleg.*')->where('caleg.idbanjar','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function report($by,$id) {

        $data = Caleg::select('caleg.*');
        if ($by == 'desa') {
            $data = Caleg::select('caleg.*')->where('caleg.iddesa','=',$id);
            $reg = \App\Desa::where('id',$id)->first();
        } elseif ($by == 'banjar') {
            $data = Caleg::select('caleg.*')->where('caleg.idbanjar','=',$id);
            $reg = \App\Banjar::where('id',$id)->first();
        }

        // dd($data->get()->toArray());
        // die();
        return view('caleg.report', compact('data','by','reg'));

    }
}
