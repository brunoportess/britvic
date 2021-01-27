@extends('template.Layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Editar veículo</h2>
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
    <form action="{{route('veiculos-atualizar', $item->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Marca</label>
                    <select class="form-control" name="marca" id="">
                        <option value="BMW" {{$item->marca == 'BMW' ? 'selected' : ''}}>BMW</option>
                        <option value="Citroën" {{$item->marca == 'Citroën' ? 'selected' : ''}}>Citroën</option>
                        <option value="Chevrolet" {{$item->marca == 'Chevrolet' ? 'selected' : ''}}>Chevrolet </option>
                        <option value="Chery" {{$item->marca == 'Chery' ? 'selected' : ''}}>Chery</option>
                        <option value="Ford" {{$item->marca == 'Ford' ? 'selected' : ''}}>Ford</option>
                        <option value="Fiat" {{$item->marca == 'Fiat' ? 'selected' : ''}}>Fiat </option>
                        <option value="Renault" {{$item->marca == 'Renault' ? 'selected' : ''}}>Renault</option>
                        <option value="Honda" {{$item->marca == 'Honda' ? 'selected' : ''}}>Honda</option>
                        <option value="Hyundai" {{$item->marca == 'Hyundai' ? 'selected' : ''}}>Hyundai</option>
                        <option value="Jeep" {{$item->marca == 'Jeep' ? 'selected' : ''}}>Jeep</option>
                        <option value="Mercedes-Benz" {{$item->marca == 'Mercedes-Benz' ? 'selected' : ''}}>Mercedes-Benz</option>
                        <option value="Mitsubishi" {{$item->marca == 'Mitsubishi' ? 'selected' : ''}}>Mitsubishi</option>
                        <option value="Nissan" {{$item->marca == 'Nissan' ? 'selected' : ''}}>Nissan</option>
                        <option value="Peugeot" {{$item->marca == 'Peugeot' ? 'selected' : ''}}>Peugeot</option>
                        <option value="Toyota" {{$item->marca == 'Toyota' ? 'selected' : ''}}>Toyota</option>
                        <option value="Volkswagen" {{$item->marca == 'Volkswagen' ? 'selected' : ''}}>Volkswagen </option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Modelo</label>
                    <input type="text" name="modelo" value="{{$item->modelo}}" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Ano</label>
                    <input type="number" name="ano" value="{{$item->ano}}" class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Formato: 9999</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Placa</label>
                    <input type="text" name="placa" value="{{$item->placa}}" class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Formato: AAA-9999</small>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a  class="btn btn-danger" href="/veiculos" role="button">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
