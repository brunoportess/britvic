@extends('template.Layout')
@section('content')
    <div class="mb-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    </div>
    <div>
        <h1 class="h1">Usuários</h1>
    </div>
    <div class="text-right">
        <a name="" id="" class="btn btn-primary text-right" href="/usuarios/formulario" role="button">NOVO USUÁRIO</a>
    </div>
    <div>
        <lista-usuarios />
    </div>
@endsection
