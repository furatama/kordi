<?php

namespace App\Http\Controllers;

use Auth;
use App\KoorL1;
use App\KoorL2;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use App\FormKoorL2;
use Illuminate\Validation\Rule;

class KoorL2Controller extends Controller
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
        $mtableref = route('koorl2.fetch');
        // return view('koorl2.index', compact('mtableref'));
        // return view('koorl2.index',['mtableref'=>route('koorl2.fetch'),'by'=>'all','id'=>'all']);
        return view('koorl2.index', compact('mtableref'), ['by'=>'all','id'=>'all']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder, $id = null)
    {
        if (!Auth::user()->hasAccess('L2C'))
            return redirect('koorl2');
        $mdata = [];
        $mdata['kontak'] = [ 
            ['tipe' => 'telp'],
            ['tipe' => 'telp'],
            ['tipe' => 'telp'],
        ];
        if ($id != null)
            $mdata['idl1'] = $id;
        $form = $formBuilder->create(FormKoorL2::class, [
            'method' => 'POST',
            'model' => $mdata,
            'url' => route('koorl2.store'),
        ]);

        return view('koorl2.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(FormKoorL2::class);

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
        $mdata = KoorL2::create($data);

        return redirect()->route('koorl2.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KoorL2  $koorL1
     * @return \Illuminate\Http\Response
     */
    public function show(KoorL2 $koorL1)
    {
        
    }

    public function showForL1($id)
    {
        $mtableref = route('koorl2.fetchForL1',$id);
        // die($mtableref);
        $person = KoorL1::where('id',$id)->first();
        return view('koorl2.index', compact('mtableref','person'), ['by'=>'koorl1','id'=>$id,'reg'=>$person]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KoorL2  $koorL1
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('L2U'))
            return redirect('koorl2');
        $mdata = KoorL2::find($id);
        $kontak = json_decode($mdata['kontak'],true);
        $mdata['kontak'] = $kontak;
        $form = $formBuilder->create(FormKoorL2::class, [
            'method' => 'PATCH',
            'model' => $mdata,
            'url' => route('koorl2.update',$id),
        ]);

        return view('koorl2.create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KoorL2  $koorL1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FormBuilder $formBuilder)
    {
        echo "update";
        $form = $formBuilder->create(FormKoorL2::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->validate($request, [
            'namalengkap' => 'required',
            'nik' => ['required','max:16','min:16',Rule::unique('koorl2')->ignore($id)],
        ], [
            'nik.required' => 'NIK masih kosong.',
            'nik.max' => 'NIK harus 16 digit.',
            'nik.min' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah dipakai.',
            'namalengkap.required' => 'Nama masih kosong.',
        ]);

        $data = $request->all();
        $data['kontak'] = json_encode($data['kontak']);
        $mdata = KoorL2::findorfail($id);
        $mdata->fill($data);
        $mdata->save();

        return redirect()->route('koorl2.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KoorL2  $koorL1
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasAccess('L2D'))
            return redirect('koorl2');
        // echo "destroy";
        $mdata = KoorL2::findorfail($id);
        $mdata->delete();

        return redirect()->route('koorl2.index');
    }

    public function fetch()
    {
        $query = KoorL2::with(['koorl1','banjar','desa','tps'])->select('koorl2.*');

        return Datatables::of($query)->make(true);
    }

    public function fetchForL1($id)
    {
        $query = KoorL2::with(['koorl1','banjar','desa','tps'])->select('koorl2.*')->where('koorl2.idl1','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function showByDesa($id)
    {
     
        $mtableref = route('koorl2.desa.fetch',$id);
        // die($mtableref);
        $desa = \App\Desa::where('id',$id)->first();
        return view('koorl2.index', compact('mtableref','desa'), ['by'=>'desa','id'=>$id,'reg'=>$desa]);

    }

    public function fetchForDesa($id)
    {
        $query = KoorL2::with(['koorl1','banjar','desa','tps'])->select('koorl2.*')->where('koorl2.iddesa','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function showByBanjar($id)
    {
     
        $mtableref = route('koorl2.banjar.fetch',$id);
        // die($mtableref);
        $banjar = \App\Banjar::where('id',$id)->first();
        return view('koorl2.index', compact('mtableref','banjar'), ['by'=>'banjar','id'=>$id,'reg'=>$banjar]);

    }

    public function fetchForBanjar($id)
    {
        $query = KoorL2::with(['koorl1','banjar','desa','tps'])->select('koorl2.*')->where('koorl2.idbanjar','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function report($by,$id) {

        $data = KoorL2::with(['koorl1','banjar','desa','tps'])->select('koorl2.*');
        if ($by == 'desa') {
            $data = KoorL2::with(['koorl1','banjar','desa','tps'])->select('koorl2.*')->where('koorl2.iddesa','=',$id);
            $reg = \App\Desa::where('id',$id)->first();
        } elseif ($by == 'banjar') {
            $data = KoorL2::with(['koorl1','banjar','desa','tps'])->select('koorl2.*')->where('koorl2.idbanjar','=',$id);
            $reg = \App\Banjar::where('id',$id)->first();
        } elseif ($by == 'koorl1') {
            $data = KoorL2::with(['koorl1','banjar','desa','tps'])->select('koorl2.*')->where('koorl2.idl1','=',$id);
            $reg = \App\KoorL1::where('id',$id)->first();
        }


        // dd($data->get()->toArray());
        // die();
        return view('koorl2.report', compact('data','by','reg'));

    }

}
