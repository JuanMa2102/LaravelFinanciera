<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Loan::select('clients.name', 'loans.*')
                ->join('clients', 'clients.id', '=', 'loans.client_id')
                ->get();

        return view('loans.index', [
            'loans' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        return view('loans.create', [
            'clients' => $clients,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_client'  => 'required|gt:0',
            'cantidad' => 'required',
            'numero_pagos' => 'required',
            'cuota' => 'required',
            'total' => 'required',
            'fecha_ministracion' => 'required',
            'fecha_vencimiento' => 'required',
        ]);

        Loan::create([
            'client_id'  => $request->input('id_client'),
            'cantidad' => $request->input('cantidad'),
            'cuota' => $request->input('cuota'),
            'total' => $request->input('total'),
            'fecha_ministracion' => $request->input('fecha_ministracion'),
            'fecha_vencimiento' => $request->input('fecha_vencimiento'),
            'numero_pagos' => $request->input('numero_pagos'),
        ]);

        return redirect()->route('loans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clients = Client::all();
        $loan = Loan::find($id);

        //$loan->fecha_ministracion=date_format($loan->fecha_ministracion, 'd-m-Y');
        $loan->fecha_ministracion = date("Y-m-d", strtotime($loan->fecha_ministracion));
        $loan->fecha_vencimiento = date("Y-m-d", strtotime($loan->fecha_vencimiento));

        return view('loans.edit',[
            'loan' => $loan,
            'clients' => $clients,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_client'  => 'required|gt:0',
            'cantidad' => 'required',
            'numero_pagos' => 'required',
            'cuota' => 'required',
            'total' => 'required',
            'fecha_ministracion' => 'required',
            'fecha_vencimiento' => 'required',
        ]);
        
        $loan  = Loan::findOrFail($id);
        $input = $request->all();
        $loan->fill($input)->save();

        return redirect()->route('loans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loan = Loan::find($id);
        $loan->delete();
        return $loan;
    }
}
