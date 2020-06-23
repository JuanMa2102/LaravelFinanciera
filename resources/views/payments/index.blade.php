@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">{{__('Payments')}}</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('Client')}}</th>
                            <th scope="col">{{__('Amount ministered')}}</th>
                            <th scope="col">{{__('Share')}}</th>
                            <th scope="col">{{__('Number of payments')}}</th>
                            <th scope="col">{{__('Payments made')}}</th>
                            <th scope="col">{{__('balance paid')}}</th>
                            <th scope="col">{{__('Outstanding balance')}}</th>
                            <th scope="col">{{__('Actions')}}</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $payment)
                        <tr>
                           
                            <td scope="row">{{ $payment-> id}}</th>
                            <td >{{ $payment-> name}}</th>
                            <td >{{ $payment-> monto_ministrado}}</th>
                            <td >{{ $payment-> cuota}}</th>
                            <td >{{ $payment-> numero_pagos}}</th>
                            <td>@php echo $paymentsAux->where('loan_id', '=', $payment->id)->count(); @endphp</td>
                            <td>@php echo '$'.$paymentsAux->where('loan_id', '=', $payment->id)->sum('cantidad'); @endphp</td>
                            <td>@php $payable = $payment->total-$paymentsAux->where('loan_id', '=', $payment->id)->sum('cantidad'); echo '$'.$payable@endphp</td>
                            <td>
                                <a href="{{ route('payments.show', ['id' => $payment->id] ) }}" class="btn btn-deafult btn-sm">
                                    {{__('Show')}}
                                <a>
                               
                            </td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
