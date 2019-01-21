<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Storage;
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
        return view('master.partai.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('A'))
            return redirect('partai');
        $mdata = [];
        $form = $formBuilder->create(FormPartai::class, [
            'method' => 'POST',
            'model' => $mdata,
            'url' => route('master.partai.store'),
        ]);

        return view('master.partai.create', compact('form'));
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
            'nourut' => 'required|unique:partai',
            'nama' => 'required',
        ], [
            'nourut.required' => 'No Urut masih kosong.',
            'nourut.unique' => 'No Urut sudah dipakai.',
            'nama.required' => 'Nama masih kosong.',
        ]);

        $data = $request->all();
        // $path = $request->file('lambang')->disk('public')->store('upload/lambang');
        if ($request->file('lambang') != null) {
            $path = $request->file('lambang')->storeAs(
                'upload/lambang', 'partai_' . $data['nourut'], 'public'
            );
            $data['lambang'] = $path;
        }
        $mdata = Partai::create($data);

        return redirect()->route('master.partai.index');
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
        if (!Auth::user()->hasAccess('A'))
            return redirect('partai');
        $mdata = Partai::find($id);
        $form = $formBuilder->create(FormPartai::class, [
            'method' => 'PATCH',
            'model' => $mdata,
            'url' => route('master.partai.update',$id),
        ]);
        $img = $mdata['lambang'];

        return view('master.partai.create', compact('form','img'));
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
            'nourut' => ['required',Rule::unique('partai')->ignore($id)],
            'nama' => 'required',
        ], [
            'nourut.required' => 'No Urut masih kosong.',
            'nourut.unique' => 'No Urut sudah dipakai.',
            'nama.required' => 'Nama masih kosong.',
        ]);

        $data = $request->all();
        if ($request->file('lambang') != null) {
            $path = $request->file('lambang')->storeAs(
                'upload/lambang', 'partai_' . $data['nourut'], 'public'
            );
            $data['lambang'] = $path;
        }

        $mdata = Partai::findorfail($id);
        $mdata->fill($data);
        $mdata->save();

        return redirect()->route('master.partai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partai  $partai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasAccess('A'))
            return redirect('partai');
        // echo "destroy";
        $mdata = Partai::findorfail($id);
        $mdata->delete();

        return redirect()->route('master.partai.index');
    }

    public function fetch()
    {
        $query = Partai::select('partai.*');

        return Datatables::of($query)->make(true);
    }

    public function showByDesa($id)
    {
     
        $mtableref = route('master.partai.desa.fetch',$id);
        // die($mtableref);
        $reg = \App\Desa::where('id',$id)->first();
        $by = 'desa';
        return view('master.partai.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForDesa($id)
    {
        $query = Partai::select('master.partai.*')->where('master.partai.iddesa','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function showByBanjar($id)
    {
     
        $mtableref = route('master.partai.banjar.fetch',$id);
        // die($mtableref);
        $reg = \App\Banjar::where('id',$id)->first();
        $by = 'banjar';
        return view('master.partai.index', compact('mtableref','reg','by','id'));

    }

    public function fetchForBanjar($id)
    {
        $query = Partai::select('master.partai.*')->where('master.partai.idbanjar','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function report($by,$id) {

        $data = Partai::select('master.partai.*');
        if ($by == 'desa') {
            $data = Partai::select('master.partai.*')->where('master.partai.iddesa','=',$id);
            $reg = \App\Desa::where('id',$id)->first();
        } elseif ($by == 'banjar') {
            $data = Partai::select('master.partai.*')->where('master.partai.idbanjar','=',$id);
            $reg = \App\Banjar::where('id',$id)->first();
        }

        // dd($data->get()->toArray());
        // die();
        return view('master.partai.report', compact('data','by','reg'));

    }
}
