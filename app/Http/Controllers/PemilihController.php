<?php

namespace App\Http\Controllers;

use Auth;
use App\Pemilih;
use App\KoorL1;
use App\KoorL2;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use App\FormPemilih;
use Illuminate\Validation\Rule;


class PemilihController extends Controller
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
        $mtableref = route('pemilih.fetch');
        return view('pemilih.index', compact('mtableref'), ['by'=>'all','id'=>'all']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder, $id = null)
    {
        if (!Auth::user()->hasAccess('PMC'))
            return redirect('pemilih');
        $mdata = [];
        $mdata['kontak'] = [ 
            ['tipe' => 'telp'],
            ['tipe' => 'telp'],
            ['tipe' => 'telp'],
        ];
        if ($id != null) {
            $mdata['idl2'] = $id;
        }
        $form = $formBuilder->create(FormPemilih::class, [
            'method' => 'POST',
            'model' => $mdata,
            'url' => route('pemilih.store'),
        ]);

        return view('pemilih.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(FormPemilih::class);

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
        $mdata = Pemilih::create($data);

        return redirect()->route('pemilih.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pemilih  $koorL1
     * @return \Illuminate\Http\Response
     */
    public function show(Pemilih $koorL1)
    {
     
    }

    public function showForL1($id)
    {
        $mtableref = route('pemilih.fetchForL1',$id);
        $person = KoorL1::where('id',$id)->first();
        $person['koorutama'] = 1;
        return view('pemilih.index', compact('mtableref','person'), ['by'=>'koorl1','id'=>$id,'reg'=>$person]);
    }

    public function showForL2($id)
    {
        $mtableref = route('pemilih.fetchForL2',$id);
        $person = KoorL2::where('id',$id)->first();
        return view('pemilih.index', compact('mtableref','person'), ['by'=>'koorl2','id'=>$id,'reg'=>$person]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pemilih  $koorL1
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('PMU'))
            return redirect('pemilih');
        $mdata = Pemilih::find($id);
        $kontak = json_decode($mdata['kontak'],true);
        $mdata['kontak'] = $kontak;
        $form = $formBuilder->create(FormPemilih::class, [
            'method' => 'PATCH',
            'model' => $mdata,
            'url' => route('pemilih.update',$id),
        ]);

        return view('pemilih.create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pemilih  $koorL1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FormBuilder $formBuilder)
    {
        // echo "update";
        $form = $formBuilder->create(FormPemilih::class);

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
        $mdata = Pemilih::findorfail($id);
        $mdata->fill($data);
        $mdata->save();

        return redirect()->route('pemilih.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pemilih  $koorL1
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasAccess('PMD'))
            return redirect('pemilih');
        // echo "destroy";
        $mdata = Pemilih::findorfail($id);
        $mdata->delete();

        return redirect()->route('pemilih.index');
    }

    public function fetch()
    {
        $query = Pemilih::with(['koorl2','banjar','desa','tps'])->select('pemilih.*');

        return Datatables::of($query)->make(true);
    }

    public function fetchForL2($id)
    {
        $query = Pemilih::with(['koorl2','banjar','desa','tps'])->select('pemilih.*')->where('pemilih.idl2','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function fetchForL1($id)
    {
        $query = Pemilih::with(['koorl2','banjar','desa','tps'])
                        ->select('pemilih.*')
                        ->join('koorl2', 'koorl2.id', '=', 'pemilih.idl2')
                        ->join('koorl1', 'koorl1.id', '=', 'koorl2.idl1')
                        ->where('koorl1.id','=',$id);

        // echo $query->get();

        return Datatables::of($query)->make(true);
    }

    public function showByDesa($id)
    {
     
        $mtableref = route('pemilih.desa.fetch',$id);
        // die($mtableref);
        $desa = \App\Desa::where('id',$id)->first();
        return view('pemilih.index', compact('mtableref','desa'), ['by'=>'desa','id'=>$id,'reg'=>$desa]);

    }

    public function fetchForDesa($id)
    {
        $query = Pemilih::with(['koorl2','banjar','desa','tps'])->select('pemilih.*')->where('pemilih.iddesa','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function showByBanjar($id)
    {
     
        $mtableref = route('pemilih.banjar.fetch',$id);
        // die($mtableref);
        $banjar = \App\Banjar::where('id',$id)->first();
        return view('pemilih.index', compact('mtableref','banjar'), ['by'=>'banjar','id'=>$id,'reg'=>$banjar]);

    }

    public function fetchForBanjar($id)
    {
        $query = Pemilih::with(['koorl2','banjar','desa','tps'])->select('pemilih.*')->where('pemilih.idbanjar','=',$id);

        return Datatables::of($query)->make(true);
    }

    public function report($by,$id) {

        $data = Pemilih::with(['koorl2','banjar','desa','tps'])->select('pemilih.*');
        if ($by == 'desa') {
            $data = Pemilih::with(['koorl2','banjar','desa','tps'])->select('pemilih.*')->where('pemilih.iddesa','=',$id);
            $reg = \App\Desa::where('id',$id)->first();
        } elseif ($by == 'banjar') {
            $data = Pemilih::with(['koorl2','banjar','desa','tps'])->select('pemilih.*')->where('pemilih.idbanjar','=',$id);
            $reg = \App\Banjar::where('id',$id)->first();
        } elseif ($by == 'koorl2') {
            $data = Pemilih::with(['koorl2','banjar','desa','tps'])->select('pemilih.*')->where('pemilih.idl2','=',$id);
            $reg = \App\KoorL2::where('id',$id)->first();
        } elseif ($by == 'koorl1') {
            $data = Pemilih::with(['koorl2','banjar','desa','tps'])->select('pemilih.*')
                                                                ->join('koorl2', 'koorl2.id', '=', 'pemilih.idl2')
                                                                ->join('koorl1', 'koorl1.id', '=', 'koorl2.idl1')
                                                                ->where('koorl1.id','=',$id);;
            $reg = \App\KoorL1::where('id',$id)->first();
        }


        // dd($data->get()->toArray());
        // die();
        return view('pemilih.report', compact('data','by','reg'));

    }

}
