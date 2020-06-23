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

            <div class="form-group form-row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <label for="cantidad">Cliente :</label>  <label>{{__('Quantity')}} :</label>
                            </br>
                            <label for="cantidad">Saldo Abonado :</label> <label>{{__('Quantity')}} :</label>
                            </br>
                            <label for="cantidad">Saldo Pendiente :</label> <label>{{__('Quantity')}} :</label>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6">
                
                    <form class="form-inline" action="{{ route('payments.store', ['id' => $loan_id] ) }}" method="POST">
                    @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" name="cantidad" id="cantidad" class="form-control @error('cantidad') is-invalid @enderror" placeholder="Cantidad">
                                            @error('cantidad')
                                                <div class="invalid-feedback">
                                                {{ $message}}
                                                </div>
                                            @enderror

                        </div>
                        <button type="submit" class="btn btn-primary mb-2">{{__('Pagar')}}</button>
                    </form>
                </div>

            </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">{{__('Number of payment')}}</th>
                            <th scope="col">{{__('Share')}}</th>
                            <th scope="col">{{__('Paid')}}</th>
                            <th scope="col">{{__('Payment date')}}</th>
                            <th scope="col">{{__('Pay date')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    

                    @for($i = 1; $i <= $loan->numero_pagos; $i++)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td scope="col">${{ $loan->cuota }}</th>
                            <td scope="col">@php echo $payments->where('numero', '=', $i)->sum('cantidad'); @endphp</th>
                            <td scope="col">{{ Carbon\Carbon::parse($loan->fecha_ministracion)->addDays($i)->format('Y-m-d') }}</th>
                            @foreach($payments as $payment)
                                @if($payment->numero == $i)
                                    <td scope="col">{{$payment->created_at}}</th>
                                @endif
                            @endforeach
                        </tr>
                    @endfor

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection