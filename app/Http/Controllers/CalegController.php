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
        return view('master.caleg.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('A'))
            return redirect('caleg');
        $mdata = [];
        $form = $formBuilder->create(FormCaleg::class, [
            'method' => 'POST',
            'model' => $mdata,
            'url' => route('master.caleg.store'),
        ]);

        return view('master.caleg.create', compact('form'));
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
            'nourut' => 'required',
            'nama' => 'required',
        ], [
            'nourut.required' => 'No Urut masih kosong.',
            'nama.required' => 'Nama masih kosong.',
        ]);

        $data = $request->all();
        // $path = $request->file('foto')->disk('public')->store('upload/foto');
        if ($request->file('foto') != null) {
            $path = $request->file('foto')->storeAs(
                'upload/foto', 'public'
            );
            $data['foto'] = $path;
        }
        $mdata = Caleg::create($data);

        return redirect()->route('master.caleg.index');
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
        if (!Auth::user()->hasAccess('A'))
            return redirect('caleg');
        $mdata = Caleg::find($id);
        $form = $formBuilder->create(FormCaleg::class, [
            'method' => 'PATCH',
            'model' => $mdata,
            'url' => route('master.caleg.update',$id),
        ]);
        $img = $mdata['foto'];

        return view('master.caleg.create', compact('form','img'));
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
            'nourut' => 'required',
            'nama' => 'required',
        ], [
            'nourut.required' => 'No Urut masih kosong.',
            'nama.required' => 'Nama masih kosong.',
        ]);

        $data = $request->all();
        if ($request->file('foto') != null) {
            $path = $request->file('foto')->storeAs(
                'upload/foto', 'public'
            );
            $data['foto'] = $path;
        }

        $mdata = Caleg::findorfail($id);
        $mdata->fill($data);
        $mdata->save();

        return redirect()->route('master.caleg.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasAccess('A'))
            return redirect('caleg');
        // echo "destroy";
        $mdata = Caleg::findorfail($id);
        $mdata->delete();

        return redirect()->route('master.caleg.index');
    }

    public function fetch()
    {
        $query = Caleg::with('partai')->select('caleg.*');

        return Datatables::of($query)->make(true);
    }

    public function showByDesa($id)
    {
     
        $mtableref = route('master.caleg.desa.fetch',$id);
        // die($mtableref);
        $reg = \App\Desa::where('id',$id)->first();
        $by = 'desa';
        return view('master.caleg.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForDesa($id)
    {
        $query = Caleg::select('master.caleg.*')->where('master.caleg.iddesa','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function showByBanjar($id)
    {
     
        $mtableref = route('master.caleg.banjar.fetch',$id);
        // die($mtableref);
        $reg = \App\Banjar::where('id',$id)->first();
        $by = 'banjar';
        return view('master.caleg.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForBanjar($id)
    {
        $query = Caleg::select('master.caleg.*')->where('master.caleg.idbanjar','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function report($by,$id) {

        $data = Caleg::select('master.caleg.*');
        if ($by == 'desa') {
            $data = Caleg::select('master.caleg.*')->where('master.caleg.iddesa','=',$id);
            $reg = \App\Desa::where('id',$id)->first();
        } elseif ($by == 'banjar') {
            $data = Caleg::select('master.caleg.*')->where('master.caleg.idbanjar','=',$id);
            $reg = \App\Banjar::where('id',$id)->first();
        }

        // dd($data->get()->toArray());
        // die();
        return view('master.caleg.report', compact('data','by','reg'));

    }
}
