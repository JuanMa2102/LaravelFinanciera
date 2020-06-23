@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">{{__('Edit Loan')}}</h3>
                    </div>
                    <div>
                        <a href="{{ route('loans.index')}}" class="btn btn-danger">
                            {{__('Cancel')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('loans.update', ['id' => $loan->id]) }}" method="POST">
                    @csrf
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            
                            <label for="cliente">{{__('Client')}}</label>
                            
                            <select id="id_client" name="id_client" class="form-control @error('id_client') is-invalid @enderror">
                            <option selected="true" disabled="disabled" >------Seleccionar------</option>
                            
                            @foreach( $clients as $client)
                                @if($client->id == $loan->client_id)
                                       <option value="{{ $client->id }}" selected >{{ $client->name }}</option>
                                @endif

                                @if($client->id != $loan->client_id)
                                       <option value="{{ $client->id }}" >{{ $client->name }}</option>
                                @endif
                                
                            @endforeach
                            </select>
                        
                            @error('id_client')
                                <div class="invalid-feedback">
                                Seleccione un cliente
                                </div>
                            @enderror
                        
                        
                        </div>
                        <div class="col-md-6">
                            
                            <label for="cantidad">{{__('Quantity')}}</label>
                            <input type="text" value="{{ $loan->cantidad }}" name="cantidad" id="cantidad" class="form-control @error('cantidad') is-invalid @enderror">
                        
                            @error('cantidad')
                                <div class="invalid-feedback">
                                {{ $message}}
                                </div>
                            @enderror

                        </div>
                    </div>
                    <div class="form-group form-row">
                            <div class="col-md-4">
                                <label for="numero_pagos">{{__('Number of payments')}}</label>
                                <input type="text" value="{{ $loan->numero_pagos }}" name="numero_pagos" id="numero_pagos" class="form-control @error('numero_pagos') is-invalid @enderror">
                        
                                    @error('numero_pagos')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                    @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="cuota">{{__('Share')}}</label>
                                <input type="text"  value="{{ $loan->cuota }}" name="cuota" id="cuota" class="form-control @error('cuota') is-invalid @enderror">
                        
                                    @error('cuota')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                    @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="total">{{__('Total')}}</label>
                                <input type="text" value="{{ $loan->total }}" name="total" id="total"  readonly="readonly" class="form-control @error('total') is-invalid @enderror">
                        
                                    @error('total')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                    @enderror
                            </div>

                    </div>

                    <div class="form-group form-row">
                            <div class="col-md-6">
                                <label for="ministracion">{{__('Date of Administration')}}</label>
                                <input type="date" value="{{ $loan->fecha_ministracion }}"  name="fecha_ministracion" id="fecha_ministracion" class="form-control @error('fecha_ministracion') is-invalid @enderror">
                        
                                    @error('ministracion')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                    @enderror
                            </div>
                                                        
                            <div class="col-md-6">
                                <label for="vencimiento">{{__('Due date')}}</label>
                                <input type="date" name="fecha_vencimiento" value="{{ $loan->fecha_vencimiento }}" id="fecha_vencimiento" readonly="readonly" class="form-control @error('fecha_vencimiento') is-invalid @enderror">
                        
                                    @error('vencimiento')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                    @enderror
                            </div>


                    </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg">{{__('Edit')}}</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('bottom-js')
<script>

$("#cuota").on('change', function() {
        
        var cuota = $('#cuota').val();
        var dias = $('#numero_pagos').val();
        document.getElementById('total').value = cuota * dias;
});

$("#numero_pagos").on('change', function() {
        
        var cuota = $('#cuota').val();
        var fecha = $('#fecha_ministracion').val();
        var dias = $('#numero_pagos').val();
        var f = sumaFecha(dias, fecha);
        document.getElementById('fecha_vencimiento').value = f;
        document.getElementById('total').value = cuota * dias;
});

$("#fecha_ministracion").on('change', function() {
        
        var fecha = $('#fecha_ministracion').val();
        var dias = $('#numero_pagos').val();
        var f = sumaFecha(dias, fecha);
        document.getElementById('fecha_vencimiento').value = f;
});

sumaFecha = function(d, fecha)
{
 var Fecha = new Date();
 var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
 var sep = sFecha.indexOf('-') != -1 ? '/' : '-';
 var aFecha = sFecha.split(sep);
 var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
 fecha= new Date(fecha);
 fecha.setDate(fecha.getDate()+parseInt(d));
 var anno=fecha.getFullYear();
 var mes= fecha.getMonth()+1;
 var dia= fecha.getDate();
 mes = (mes < 10) ? ("0" + mes) : mes;
 dia = (dia < 10) ? ("0" + dia) : dia;
 var fechaFinal = anno+"-"+mes+"-"+dia;
 return (fechaFinal);
 }
</script>
@endsection