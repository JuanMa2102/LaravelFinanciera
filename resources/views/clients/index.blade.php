@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">Clientes</h3>
                    </div>
                    <div>
                        <a href="{{ route('clients.create')}}" class="btn btn-primary">
                            {{__('New Client')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('Name')}}</th>
                            <th scope="col">{{__('Phone')}}</th>
                            <th scope="col">{{__('Address')}}</th>
                            <th scope="col">{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $client)
                        <tr>
                           
                            <td scope="row">{{ $client-> id}}</th>
                            <td >{{ $client-> name}}</th>
                            <td >{{ $client-> phone}}</th>
                            <td >{{ $client-> address}}</th>
                            <td>
                                <a href="{{ route('clients.edit', ['id' => $client->id]) }}" class="btn btn-deafult btn-sm">
                                    {{__('Show')}}
                                <a>
                                <button class="btn btn-danger bnt-sm btn-delete" data-id="{{ $client->id}}">{{__('Delete')}}</button>
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
            axios.delete('{{ route('clients.index') }}/' + id)
                    .then(result => {
                        Swal.fire(
                        'Elimidado!',
                        'El cliente a sido eliminado.',
                        'success'
                        );
                        window.location.href='{{ route('clients.index') }}';
                    })
                    .catch(error =>{
                        Swal.fire(
                        'Error!',
                        'El cliente no se ha eliminado.',
                        'error'
                        );
                    });
        }
        });
        
    });
   
</script>
@endsection