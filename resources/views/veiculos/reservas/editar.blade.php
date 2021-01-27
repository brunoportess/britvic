@extends('template.Layout')
@section('content')
    <div class="row">
        <div class="col-12 mb-3 font-weight-bold">
            <h2>Editar reserva</h2>
        </div>
    </div>
    <div>
        <reservas-formulario :item="{{ $item }}"/>
    </div>
@endsection
