<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\KeyBanjar;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use App\FormKeyBanjar;
use Illuminate\Validation\Rule;

class KeyBanjarController extends Controller
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
        return view('keybanjar.index',['by'=>'all','id'=>'all']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('L1C'))
            return redirect('keybanjar');
        $mdata = [];
        $form = $formBuilder->create(FormKeyBanjar::class, [
            'method' => 'POST',
            'model' => $mdata,
            'url' => route('keybanjar.store'),
        ]);

        return view('keybanjar.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $formBuilder)
    {

        $form = $formBuilder->create(FormKeyBanjar::class);

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
        $mdata = KeyBanjar::create($data);

        return redirect()->route('keybanjar.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KeyBanjar  $keyBanjar
     * @return \Illuminate\Http\Response
     */
    public function show(KeyBanjar $keyBanjar)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KeyBanjar  $keyBanjar
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('L1U'))
            return redirect('keybanjar');
        $mdata = KeyBanjar::find($id);
        $kontak = json_decode($mdata['kontak'],true);
        $mdata['kontak'] = $kontak;
        $form = $formBuilder->create(FormKeyBanjar::class, [
            'method' => 'PATCH',
            'model' => $mdata,
            'url' => route('keybanjar.update',$id),
        ]);

        return view('keybanjar.create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KeyBanjar  $keyBanjar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(FormKeyBanjar::class);

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
        $mdata = KeyBanjar::findorfail($id);
        $mdata->fill($data);
        $mdata->save();

        return redirect()->route('keybanjar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KeyBanjar  $keyBanjar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasAccess('L1D'))
            return redirect('keybanjar');
        // echo "destroy";
        $mdata = KeyBanjar::findorfail($id);
        $mdata->delete();

        return redirect()->route('keybanjar.index');
    }

    public function fetch()
    {
        $query = KeyBanjar::with(['banjar','desa'])->select('keybanjar.*');

        return Datatables::of($query)->make(true);
    }

    public function showByDesa($id)
    {
     
        $mtableref = route('keybanjar.desa.fetch',$id);
        // die($mtableref);
        $reg = \App\Desa::where('id',$id)->first();
        $by = 'desa';
        return view('keybanjar.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForDesa($id)
    {
        $query = KeyBanjar::with(['banjar','desa'])->select('keybanjar.*')->where('keybanjar.iddesa','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function showByBanjar($id)
    {
     
        $mtableref = route('keybanjar.banjar.fetch',$id);
        // die($mtableref);
        $reg = \App\Banjar::where('id',$id)->first();
        $by = 'banjar';
        return view('keybanjar.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForBanjar($id)
    {
        $query = KeyBanjar::with(['banjar','desa'])->select('keybanjar.*')->where('keybanjar.idbanjar','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function report($by,$id) {

        $data = KeyBanjar::with(['banjar','desa'])->select('keybanjar.*');
        if ($by == 'desa') {
            $data = KeyBanjar::with(['banjar','desa'])->select('keybanjar.*')->where('keybanjar.iddesa','=',$id);
            $reg = \App\Desa::where('id',$id)->first();
        } elseif ($by == 'banjar') {
            $data = KeyBanjar::with(['banjar','desa'])->select('keybanjar.*')->where('keybanjar.idbanjar','=',$id);
            $reg = \App\Banjar::where('id',$id)->first();
        }

        // dd($data->get()->toArray());
        // die();
        return view('keybanjar.report', compact('data','by','reg'));

    }
}
