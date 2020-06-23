@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">{{__('Edit Client')}}</h3>
                    </div>
                    <div>
                        <a href="{{ route('clients.index')}}" class="btn btn-danger">
                            {{__('Cancel')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('clients.update', ['id' => $client->id]) }}" method="POST">
                    @csrf
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" name="name" id="name" value="{{ $client->name }}" class="form-control @error('name') is-invalid @enderror">
                        
                            @error('name')
                                <div class="invalid-feedback">
                                {{ $message}}
                                </div>
                            @enderror
                        
                        
                        </div>
                        <div class="col-md-6">
                            <label for="phone">{{__('Phone')}}</label>
                            <input type="text" name="phone" id="phone" value="{{ $client->phone }}" class="form-control @error('phone') is-invalid @enderror">
                        
                            @error('phone')
                                <div class="invalid-feedback">
                                {{ $message}}
                                </div>
                            @enderror
                        </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-md-12">
                                <label for="address">{{__('Address')}}</label>
                                <input type="text" name="address" id="address" value="{{ $client->address }}" class="form-control @error('address') is-invalid @enderror">
                        
                                    @error('address')
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