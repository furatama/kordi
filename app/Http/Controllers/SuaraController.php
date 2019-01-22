<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Suara;
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
