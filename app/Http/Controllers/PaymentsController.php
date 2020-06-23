<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Client;
use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Loan::select('loans.id','clients.name', 'loans.cantidad as monto_ministrado','loans.cuota','loans.numero_pagos', 'loans.total')//,'0 as pagos_realizados', '0 saldo_abonado', '0 saldo_pendiente')
                ->join('clients', 'clients.id', '=', 'loans.client_id')
                ->get();

        $payments = Payment::all();
             

        return view('payments.index', [
            'payments' => $data,
            'paymentsAux' => $payments,
        ]);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data = Payment::select('payments.*')
                ->where('loan_id', '=', $id)
                ->orderBy('numero', 'desc')
                ->first();
        
        if($data == null)
            $numero_pago = 1;
        else
            $numero_pago = $data->numero+1;

        //dd($numero_pago);
        return view('payments.create', [
            'loan_id' => $id,
            'numero_pago' => $numero_pago,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'cantidad'  => 'required',
        ]);

        $data = Payment::select('payments.*', 'loans.cuota')
                ->join('loans', 'loans.id', '=', 'payments.loan_id')
                ->where('loan_id', '=', $id)
                ->orderBy('numero', 'desc')
                ->first();
        $payments = Payment::select('cantidad')->where('loan_id', '=', $id)->get();
        $cant = $request->input('cantidad');
        $cuota = $data->cuota;
        $payment_number = $payments->count() + 1;

        if($data != null){

            if($data->cantidad != $cuota){
                $pago = $cuota;
                if($cant >= ($cuota - $data->cantidad)){
                    $cant = $cant - ($cuota - $data->cantidad);
                }
                else{
                    $pago = $data->cantidad + $cant;
                    $cant = 0;
                }

                $client  = Payment::findOrFail($data->id);
                $client->cantidad = $pago;
                $client->save();
            }
        }

        $veces = intdiv($cant,$cuota);
        $resto = $cant % $cuota;

        for($i = 0; $i < $veces; $i++)
        {
            Payment::create([
                'loan_id'  => $id,
                'numero' => $payment_number + $i,
                'cantidad' => $cuota,
            ]);
        }

        if($resto != 0){

            $payments = Payment::select('cantidad')->where('loan_id', '=', $id)->get();
            $payment_number = $payments->count() + 1;
            Payment::create([
                'loan_id'  => $id,
                'numero' => $payment_number,
                'cantidad' => $resto,
            ]);
        }

        
        $dataPayment = Payment::select('payments.*','loans.cuota')
                ->join('loans', 'loans.id', '=', 'payments.loan_id')
                ->where('loan_id', '=', $id)
                ->get();
        
        $loans = Loan::select('loans.*')
                ->where('id', '=', $id)
                ->first();

                return view('payments.show', [
                    'payments' => $dataPayment,
                    'loan' => $loans,
                    'loan_id' => $id,
                ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Payment::select('payments.*','loans.cuota')
                ->join('loans', 'loans.id', '=', 'payments.loan_id')
                ->where('loan_id', '=', $id)
                ->get();
        
        $loans = Loan::select('loans.*')
                ->where('id', '=', $id)
                ->first();

                return view('payments.show', [
                    'payments' => $data,
                    'loan' => $loans,
                    'loan_id' => $id,
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
