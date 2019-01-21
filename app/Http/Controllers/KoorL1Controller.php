<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\KoorL1;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use App\FormKoorL1;
use Illuminate\Validation\Rule;

class KoorL1Controller extends Controller
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
        return view('koorl1.index',['by'=>'all','id'=>'all']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('L1C'))
            return redirect('koorl1');
        $mdata = [];
        $mdata['kontak'] = [ 
            ['tipe' => 'telp'],
            ['tipe' => 'telp'],
            ['tipe' => 'telp'],
        ];
        $form = $formBuilder->create(FormKoorL1::class, [
            'method' => 'POST',
            'model' => $mdata,
            'url' => route('koorl1.store'),
        ]);

        return view('koorl1.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $formBuilder)
    {

        $form = $formBuilder->create(FormKoorL1::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->validate($request, [
            'namalengkap' => 'required',
            'nik' => 'required|unique:koorl1|max:16|min:16',
        ], [
            'nik.required' => 'NIK masih kosong.',
            'nik.max' => 'NIK harus 16 digit.',
            'nik.min' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah dipakai.',
            'namalengkap.required' => 'Nama masih kosong.',
        ]);

        $data = $request->all();
        $data['kontak'] = json_encode($data['kontak']);
        $mdata = KoorL1::create($data);

        return redirect()->route('koorl1.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KoorL1  $koorL1
     * @return \Illuminate\Http\Response
     */
    public function show(KoorL1 $koorL1)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KoorL1  $koorL1
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('L1U'))
            return redirect('koorl1');
        $mdata = KoorL1::find($id);
        $kontak = json_decode($mdata['kontak'],true);
        $mdata['kontak'] = $kontak;
        $form = $formBuilder->create(FormKoorL1::class, [
            'method' => 'PATCH',
            'model' => $mdata,
            'url' => route('koorl1.update',$id),
        ]);

        return view('koorl1.create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KoorL1  $koorL1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(FormKoorL1::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->validate($request, [
            'namalengkap' => 'required',
            'nik' => ['required','max:16','min:16',Rule::unique('koorl1')->ignore($id)],
        ], [
            'nik.required' => 'NIK masih kosong.',
            'nik.max' => 'NIK harus 16 digit.',
            'nik.min' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah dipakai.',
            'namalengkap.required' => 'Nama masih kosong.',
        ]);

        $data = $request->all();
        $data['kontak'] = json_encode($data['kontak']);
        $mdata = KoorL1::findorfail($id);
        $mdata->fill($data);
        $mdata->save();

        return redirect()->route('koorl1.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KoorL1  $koorL1
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasAccess('L1D'))
            return redirect('koorl1');
        // echo "destroy";
        $mdata = KoorL1::findorfail($id);
        $mdata->delete();

        return redirect()->route('koorl1.index');
    }

    public function fetch()
    {
        $query = KoorL1::with(['banjar','desa','tps'])->select('koorl1.*');

        return Datatables::of($query)->make(true);
    }

    public function showByDesa($id)
    {
     
        $mtableref = route('koorl1.desa.fetch',$id);
        // die($mtableref);
        $reg = \App\Desa::where('id',$id)->first();
        $by = 'desa';
        return view('koorl1.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForDesa($id)
    {
        $query = KoorL1::with(['banjar','desa','tps'])->select('koorl1.*')->where('koorl1.iddesa','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function showByBanjar($id)
    {
     
        $mtableref = route('koorl1.banjar.fetch',$id);
        // die($mtableref);
        $reg = \App\Banjar::where('id',$id)->first();
        $by = 'banjar';
        return view('koorl1.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForBanjar($id)
    {
        $query = KoorL1::with(['banjar','desa','tps'])->select('koorl1.*')->where('koorl1.idbanjar','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function report($by,$id) {

        $data = KoorL1::with(['banjar','desa','tps'])->select('koorl1.*');
        if ($by == 'desa') {
            $data = KoorL1::with(['banjar','desa','tps'])->select('koorl1.*')->where('koorl1.iddesa','=',$id);
            $reg = \App\Desa::where('id',$id)->first();
        } elseif ($by == 'banjar') {
            $data = KoorL1::with(['banjar','desa','tps'])->select('koorl1.*')->where('koorl1.idbanjar','=',$id);
            $reg = \App\Banjar::where('id',$id)->first();
        }

        // dd($data->get()->toArray());
        // die();
        return view('koorl1.report', compact('data','by','reg'));

    }
}
