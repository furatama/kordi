<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Relawan;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use App\FormRelawan;
use Illuminate\Validation\Rule;

class RelawanController extends Controller
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
        return view('relawan.index',['by'=>'all','id'=>'all']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('RLC'))
            return redirect('relawan');
        $mdata = [];
        $mdata['kontak'] = [ 
            ['tipe' => 'telp'],
            ['tipe' => 'telp'],
            ['tipe' => 'telp'],
        ];
        $form = $formBuilder->create(FormRelawan::class, [
            'method' => 'POST',
            'model' => $mdata,
            'url' => route('relawan.store'),
        ]);

        return view('relawan.create', compact('form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $formBuilder)
    {

        $form = $formBuilder->create(FormRelawan::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->validate($request, [
            'namalengkap' => 'required',
            'nik' => 'required|unique:relawan|max:16|min:16',
        ], [
            'nik.required' => 'NIK masih kosong.',
            'nik.max' => 'NIK harus 16 digit.',
            'nik.min' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah dipakai.',
            'namalengkap.required' => 'Nama masih kosong.',
        ]);

        $data = $request->all();
        $data['kontak'] = json_encode($data['kontak']);
        $mdata = Relawan::create($data);

        return redirect()->route('relawan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Relawan  $relawan
     * @return \Illuminate\Http\Response
     */
    public function show(Relawan $relawan)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Relawan  $relawan
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('RLU'))
            return redirect('relawan');
        $mdata = Relawan::find($id);
        $kontak = json_decode($mdata['kontak'],true);
        $mdata['kontak'] = $kontak;
        $form = $formBuilder->create(FormRelawan::class, [
            'method' => 'PATCH',
            'model' => $mdata,
            'url' => route('relawan.update',$id),
        ]);

        return view('relawan.create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Relawan  $relawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(FormRelawan::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->validate($request, [
            'namalengkap' => 'required',
            'nik' => ['required','max:16','min:16',Rule::unique('relawan')->ignore($id)],
        ], [
            'nik.required' => 'NIK masih kosong.',
            'nik.max' => 'NIK harus 16 digit.',
            'nik.min' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah dipakai.',
            'namalengkap.required' => 'Nama masih kosong.',
        ]);

        $data = $request->all();
        $data['kontak'] = json_encode($data['kontak']);
        $mdata = Relawan::findorfail($id);
        $mdata->fill($data);
        $mdata->save();

        return redirect()->route('relawan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Relawan  $relawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasAccess('RLD'))
            return redirect('relawan');
        // echo "destroy";
        $mdata = Relawan::findorfail($id);
        $mdata->delete();

        return redirect()->route('relawan.index');
    }

    public function fetch()
    {
        $query = Relawan::select('relawan.*');

        return Datatables::of($query)->make(true);
    }

    public function showByDesa($id)
    {
     
        $mtableref = route('relawan.desa.fetch',$id);
        // die($mtableref);
        $reg = \App\Desa::where('id',$id)->first();
        $by = 'desa';
        return view('relawan.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForDesa($id)
    {
        $query = Relawan::select('relawan.*')->where('relawan.iddesa','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function showByBanjar($id)
    {
     
        $mtableref = route('relawan.banjar.fetch',$id);
        // die($mtableref);
        $reg = \App\Banjar::where('id',$id)->first();
        $by = 'banjar';
        return view('relawan.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForBanjar($id)
    {
        $query = Relawan::select('relawan.*')->where('relawan.idbanjar','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function report($by,$id) {

        $data = Relawan::select('relawan.*');
        if ($by == 'desa') {
            $data = Relawan::select('relawan.*')->where('relawan.iddesa','=',$id);
            $reg = \App\Desa::where('id',$id)->first();
        } elseif ($by == 'banjar') {
            $data = Relawan::select('relawan.*')->where('relawan.idbanjar','=',$id);
            $reg = \App\Banjar::where('id',$id)->first();
        }

        // dd($data->get()->toArray());
        // die();
        return view('relawan.report', compact('data','by','reg'));

    }
}
