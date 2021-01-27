@extends('template.Layout')
@section('content')
    <div class="mb-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    </div>
    <div class="text-right">
        <a name="" id="" class="btn btn-primary text-right" href="/veiculos/formulario" role="button">NOVO VEÍCULO</a>
    </div>
    <div>
        <lista-veiculos />
    </div>
@endsection
