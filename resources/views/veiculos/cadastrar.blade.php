@extends('template.Layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Cadastrar veículo</h2>
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
    <form action="{{route('veiculos-salvar')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Marca</label>
                    <select class="form-control" name="marca" id="">
                        <option value="BMW">BMW</option>
                        <option value="Citroën">Citroën</option>
                        <option value="Chevrolet">Chevrolet </option>
                        <option value="Chery">Chery</option>
                        <option value="Ford">Ford</option>
                        <option value="Fiat">Fiat </option>
                        <option value="Renault">Renault</option>
                        <option value="Honda">Honda</option>
                        <option value="Hyundai">Hyundai</option>
                        <option value="Jeep">Jeep</option>
                        <option value="Mercedes-Benz">Mercedes-Benz</option>
                        <option value="Mitsubishi">Mitsubishi</option>
                        <option value="Nissan">Nissan</option>
                        <option value="Peugeot">Peugeot</option>
                        <option value="Toyota">Toyota</option>
                        <option value="Volkswagen">Volkswagen </option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Modelo</label>
                    <input type="text" name="modelo" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Ano</label>
                    <input type="number" name="ano" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Formato: 9999</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Placa</label>
                    <input type="text" name="placa" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Formato: AAA-9999</small>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a  class="btn btn-danger" href="/veiculos" role="button">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
