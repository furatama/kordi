<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\KeyKomunitas;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use App\FormKeyKomunitas;
use Illuminate\Validation\Rule;

class KeyKomunitasController extends Controller
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
        return view('keykomunitas.index',['by'=>'all','id'=>'all']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('L1C'))
            return redirect('keykomunitas');
        $mdata = [];
        $form = $formBuilder->create(FormKeyKomunitas::class, [
            'method' => 'POST',
            'model' => $mdata,
            'url' => route('keykomunitas.store'),
        ]);

        return view('keykomunitas.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $formBuilder)
    {

        $form = $formBuilder->create(FormKeyKomunitas::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->validate($request, [
            'nama' => 'required',
            'nik' => 'max:16|min:16',
        ], [
            'nik.required' => 'NIK masih kosong.',
            'nik.max' => 'NIK harus 16 digit.',
            'nik.min' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah dipakai.',
            'nama.required' => 'Nama masih kosong.',
        ]);

        $data = $request->all();
        $mdata = KeyKomunitas::create($data);

        return redirect()->route('keykomunitas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KeyKomunitas  $keyBanjar
     * @return \Illuminate\Http\Response
     */
    public function show(KeyKomunitas $keyBanjar)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KeyKomunitas  $keyBanjar
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('L1U'))
            return redirect('keykomunitas');
        $mdata = KeyKomunitas::find($id);
        $kontak = json_decode($mdata['kontak'],true);
        $mdata['kontak'] = $kontak;
        $form = $formBuilder->create(FormKeyKomunitas::class, [
            'method' => 'PATCH',
            'model' => $mdata,
            'url' => route('keykomunitas.update',$id),
        ]);

        return view('keykomunitas.create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KeyKomunitas  $keyBanjar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(FormKeyKomunitas::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->validate($request, [
            'nama' => 'required',
            'nik' => ['required','max:16','min:16',Rule::unique('relawan')->ignore($id)],
        ], [
            'nik.required' => 'NIK masih kosong.',
            'nik.max' => 'NIK harus 16 digit.',
            'nik.min' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah dipakai.',
            'nama.required' => 'Nama masih kosong.',
        ]);

        $data = $request->all();
        $mdata = KeyKomunitas::findorfail($id);
        $mdata->fill($data);
        $mdata->save();

        return redirect()->route('keykomunitas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KeyKomunitas  $keyBanjar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasAccess('L1D'))
            return redirect('keykomunitas');
        // echo "destroy";
        $mdata = KeyKomunitas::findorfail($id);
        $mdata->delete();

        return redirect()->route('keykomunitas.index');
    }

    public function fetch()
    {
        $query = KeyKomunitas::select('keykomunitas.*');

        return Datatables::of($query)->make(true);
    }

    public function showByDesa($id)
    {
     
        $mtableref = route('keykomunitas.desa.fetch',$id);
        // die($mtableref);
        $reg = \App\Desa::where('id',$id)->first();
        $by = 'desa';
        return view('keykomunitas.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForDesa($id)
    {
        $query = KeyKomunitas::select('keykomunitas.*')->where('keykomunitas.iddesa','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function showByBanjar($id)
    {
     
        $mtableref = route('keykomunitas.banjar.fetch',$id);
        // die($mtableref);
        $reg = \App\Banjar::where('id',$id)->first();
        $by = 'banjar';
        return view('keykomunitas.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForBanjar($id)
    {
        $query = KeyKomunitas::select('keykomunitas.*')->where('keykomunitas.idbanjar','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function report($by,$id) {

        $data = KeyKomunitas::select('keykomunitas.*');
        if ($by == 'desa') {
            $data = KeyKomunitas::select('keykomunitas.*')->where('keykomunitas.iddesa','=',$id);
            $reg = \App\Desa::where('id',$id)->first();
        } elseif ($by == 'banjar') {
            $data = KeyKomunitas::select('keykomunitas.*')->where('keykomunitas.idbanjar','=',$id);
            $reg = \App\Banjar::where('id',$id)->first();
        }

        // dd($data->get()->toArray());
        // die();
        return view('keykomunitas.report', compact('data','by','reg'));

    }
}
