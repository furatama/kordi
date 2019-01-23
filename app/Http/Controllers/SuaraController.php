<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Validator;
use App\Suara;
use App\Partai;
use App\Caleg;
use App\TPS;
use App\Desa;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use App\FormSuara;
use Illuminate\Validation\Rule;

class SuaraController extends Controller
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
        return view("suara.index",['by'=>'all','id'=>'all']);
    }

    public function fetch()
    {
        $query = Suara::with(['tps','caleg'])->select('suara.*');

        return Datatables::of($query)->make(true);
    }

    public function fetchOne($tps, $caleg)
    {
        $mdata = Suara::where([
            ['idcaleg','=',$caleg],
            ['idtps','=',$tps],
        ])->first();

        $request = [];
        if ($mdata == null) {
            $request['result'] = 'NULL';
        } else {
            $request = [
                'result' => 'OK',
                'data' => $mdata
            ];
        }

        echo json_encode($request);
    }

    public function tabel() {

        // $query = DB::select("SELECT 


        //     SELECT banjar.id,banjar.nama,l1n,l2n,pn FROM banjar 
        //                     LEFT JOIN (SELECT idbanjar,COUNT(*) as l1n FROM koorl1 GROUP BY idbanjar) l1 
        //                     ON l1.idbanjar = banjar.id
        //                     LEFT JOIN (SELECT idbanjar,COUNT(*) as l2n FROM koorl2 GROUP BY idbanjar) l2 
        //                     ON l2.idbanjar = banjar.id 
        //                     LEFT JOIN (SELECT idbanjar,COUNT(*) as pn FROM pemilih GROUP BY idbanjar) p 
        //                     ON p.idbanjar = banjar.id 
        //                     GROUP BY banjar.id");

        // $data = [
        //     [
        //         'idpartai' => 1,
        //         'caleg' => [
        //             [
        //                 'nourut' => 1,
        //                 'nama' => 'nama',
        //             ],
        //             [
        //                 'nourut' => 2,
        //                 'nama' => 'nama',
        //             ],
        //         ]
        //     ]
        // ];

        $data = [];

        $partai = Partai::all();
        foreach ($partai as $key => $value) {
            $idp = $value['id'];
            $data[] = [
                'idpartai' => $value['id'],
                'nourut' => $value['nourut'],
                'lambang' => $value['lambang'],
                'nama' => $value['nama'],
            ];

            $calegs = Caleg::where('idpartai','=',$idp)->get();
            // dump($calegs);
            foreach ($calegs as $key => $value) {
                $query = DB::select("
                    SELECT ifnull(suara,0) as suara,desa.id as iddesa FROM desa LEFT JOIN (SELECT SUM(suara.suara) as suara, desa.id as iddesa FROM desa 
                    INNER JOIN banjar ON desa.id = banjar.iddesa
                    INNER JOIN tps ON banjar.id = tps.idbanjar
                    INNER JOIN suara ON tps.id = suara.idtps
                    WHERE suara.idcaleg = " . $value['id'] . "
                    GROUP BY desa.id) sr ON sr.iddesa = desa.id
                    ");
                $data[] = [
                    'nourut' => $value['nourut'],
                    'foto' => $value['foto'],
                    'nama' => $value['nama'],
                    'suara' => $query,
                ];
                // dump($query);
            }
        }
        // die();

        $cols = Desa::all();

        return view('suara.peta',compact('data','cols'));

        // dd($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        if (!Auth::user()->hasAccess('SUC'))
            return redirect('suara');
        $mdata = [];
        $mdata['tglsuara'] = date('Y-m-d');
        $mdata['penanggung'] = Auth::user()->username;
        $form = $formBuilder->create(FormSuara::class, [
            'method' => 'POST',
            'model' => $mdata,
            'url' => route('suara.store'),
        ]);

        return view("suara.create", compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $formBuilder)
    {

        $form = $formBuilder->create(FormSuara::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $mdata = Suara::where([
            ['idcaleg','=',$request->input('idcaleg')],
            ['idtps','=',$request->input('idtps')],
        ])->first();

        $data = $request->all();
        if ($mdata == null) {
            $mdata = Suara::create($data);
        } else {
            $mdata->fill($data);
            $mdata->save();
        }


        return redirect()->route('suara.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Suara  $suara
     * @return \Illuminate\Http\Response
     */
    public function show(Suara $suara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Suara  $suara
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        //
        if (!Auth::user()->hasAccess('SUU'))
            return redirect('suara');
        $mdata = Suara::find($id);
        $form = $formBuilder->create(FormSuara::class, [
            'method' => 'PATCH',
            'model' => $mdata,
            'url' => route('suara.update',$id),
        ]);

        return view("suara.create", compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suara  $suara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(FormSuara::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $mdata = Suara::findorfail($id);

        $data = $request->all();
        $mdata->fill($data);
        $mdata->save();

        return redirect()->route('suara.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Suara  $suara
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasAccess('SUD'))
            return redirect('suara');
        // echo "destroy";
        $mdata = Suara::findorfail($id);
        $mdata->delete();

        return redirect()->route('suara.index');
    }
}
