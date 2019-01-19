<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Partai;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use App\FormPartai;
use Illuminate\Validation\Rule;

class PartaiController extends Controller
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
        return view('partai.index',['by'=>'all','id'=>'all']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('L1C'))
            return redirect('partai');
        $mdata = [];
        $form = $formBuilder->create(FormPartai::class, [
            'method' => 'POST',
            'model' => $mdata,
            'url' => route('partai.store'),
        ]);

        return view('partai.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $formBuilder)
    {

        $form = $formBuilder->create(FormPartai::class);

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
        $mdata = Partai::create($data);

        return redirect()->route('partai.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Partai  $partai
     * @return \Illuminate\Http\Response
     */
    public function show(Partai $partai)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Partai  $partai
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('L1U'))
            return redirect('partai');
        $mdata = Partai::find($id);
        $kontak = json_decode($mdata['kontak'],true);
        $mdata['kontak'] = $kontak;
        $form = $formBuilder->create(FormPartai::class, [
            'method' => 'PATCH',
            'model' => $mdata,
            'url' => route('partai.update',$id),
        ]);

        return view('partai.create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partai  $partai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(FormPartai::class);

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
        $mdata = Partai::findorfail($id);
        $mdata->fill($data);
        $mdata->save();

        return redirect()->route('partai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partai  $partai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasAccess('L1D'))
            return redirect('partai');
        // echo "destroy";
        $mdata = Partai::findorfail($id);
        $mdata->delete();

        return redirect()->route('partai.index');
    }

    public function fetch()
    {
        $query = Partai::select('partai.*');

        return Datatables::of($query)->make(true);
    }

    public function showByDesa($id)
    {
     
        $mtableref = route('partai.desa.fetch',$id);
        // die($mtableref);
        $reg = \App\Desa::where('id',$id)->first();
        $by = 'desa';
        return view('partai.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForDesa($id)
    {
        $query = Partai::select('partai.*')->where('partai.iddesa','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function showByBanjar($id)
    {
     
        $mtableref = route('partai.banjar.fetch',$id);
        // die($mtableref);
        $reg = \App\Banjar::where('id',$id)->first();
        $by = 'banjar';
        return view('partai.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForBanjar($id)
    {
        $query = Partai::select('partai.*')->where('partai.idbanjar','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function report($by,$id) {

        $data = Partai::select('partai.*');
        if ($by == 'desa') {
            $data = Partai::select('partai.*')->where('partai.iddesa','=',$id);
            $reg = \App\Desa::where('id',$id)->first();
        } elseif ($by == 'banjar') {
            $data = Partai::select('partai.*')->where('partai.idbanjar','=',$id);
            $reg = \App\Banjar::where('id',$id)->first();
        }

        // dd($data->get()->toArray());
        // die();
        return view('partai.report', compact('data','by','reg'));

    }
}
