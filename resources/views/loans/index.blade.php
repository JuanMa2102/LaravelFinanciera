@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">{{__('Loans')}}</h3>
                    </div>
                    <div>
                        <a href="{{ route('loans.create')}}" class="btn btn-primary">
                            {{__('New Loan')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('Client')}}</th>
                            <th scope="col">{{__('Quantity')}}</th>
                            <th scope="col">{{__('Number of payments')}}</th>
                            <th scope="col">{{__('Share')}}</th>
                            <th scope="col">{{__('Total')}}</th>
                            <th scope="col">{{__('Date of Administration')}}</th>
                            <th scope="col">{{__('Due date')}}</th>
                            <th scope="col">{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($loans as $loan)
                        <tr>
                            <td scope="row">{{ $loan-> id}}</th>
                            <td >{{ $loan-> name}}</th>
                            <td >{{ $loan-> cantidad}}</th>
                            <td >{{ $loan-> numero_pagos}}</th>
                            <td >{{ $loan-> cuota}}</th>
                            <td >{{ $loan-> total}}</th>
                            <td >{{ date("Y-m-d", strtotime($loan->fecha_ministracion)) }}</th>
                            <td >{{ date("Y-m-d", strtotime($loan->fecha_vencimiento)) }}</th>
                            <td>
                                <a href="{{ route('loans.edit', ['id' => $loan->id]) }}" class="btn btn-sm">
                                    {{__('Show')}}
                                <a>
                                
                                <a href="{{ route('payments.index', ['id' => $loan->id]) }}" class="btn  btn-sm">
                                    {{__('Payments')}}
                                <a>
                                <button class="btn bnt-sm btn-delete" data-id="{{ $loan->id}}">{{__('Delete')}}</button>
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

@section('bottom-js')
<script>
    $('body').on('click','.btn-delete', function(event){
        const id = $(this).data('id');
        Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esta accipon!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminelo!'
        }).then((result) => {
        if (result.value) {
            axios.delete('{{ route('loans.index') }}/' + id)
                    .then(result => {
                        Swal.fire(
                        'Elimidado!',
                        'El prestamo a sido eliminado.',
                        'success'
                        );
                        window.location.href='{{ route('loans.index') }}';
                    })
                    .catch(error =>{
                        Swal.fire(
                        'Error!',
                        'El prestamo no se ha eliminado.',
                        'error'
                        );
                    });
        }
        });
        
    });
   
</script>
@endsection