@extends('template.Layout')
@section('content')
    <div class="row">
        <div class="col-12 mb-3 font-weight-bold">
            <h2>Cadastrar usuário</h2>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Há alguns problemas com os dados<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('usuarios-salvar')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nome</label>
                    <input type="text" name="nome" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">CPF</label>
                    <input type="text" name="cpf" id="" class="form-control" placeholder="999.999.999-99" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Formato: 999.999.999-99</small>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a  class="btn btn-danger" href="/usuarios" role="button">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
