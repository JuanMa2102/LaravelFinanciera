@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">{{__('New Payment')}}</h3>
                    </div>
                    <div>
                        <a href="{{ route('payments.index', ['id' => $loan_id]) }}" class="btn btn-danger">
                            {{__('Cancel')}}
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <form action="{{ route('payments.store', ['id' => $loan_id] ) }}" method="POST">
                    @csrf
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            
                            <label for="numero_pago">{{__('Number of payment')}}</label>
                            <input type="text" value="{{ $numero_pago }}" name="numero_pago" id="numero_pago" class="form-control @error('numero_pago') is-invalid @enderror" readonly="readonly">
                        
                            @error('numero_pago')
                                <div class="invalid-feedback">
                                {{ $message}}
                                </div>
                            @enderror
                        
                        
                        </div>
                        <div class="col-md-6">
                            <label for="cantidad">{{__('Quantity')}}</label>
                            <input type="text" name="cantidad" id="cantidad" class="form-control @error('cantidad') is-invalid @enderror">
                        
                            @error('cantidad')
                                <div class="invalid-feedback">
                                {{ $message}}
                                </div>
                            @enderror
                        </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg">{{__('Create')}}</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection