<?php


namespace App\Repositories;


use App\Models\Veiculo;
use App\Repositories\Interfaces\IVeiculosRepository;
use Illuminate\Database\Eloquent\Builder;

class VeiculosRepository extends BaseRepository implements IVeiculosRepository
{
    /**
     * @var Veiculo
     */
    private $veiculos;

    public function __construct(Veiculo $veiculos)
    {
        parent::__construct($veiculos);
        $this->veiculos = $veiculos;
    }

    function listarDisponiveis($inicio, $fim)
    {
        try {
            // VERIFICA SE A DATA DE INICIO OU FIM DE LOCAÇÃO SELECIONADA O VEICULO NAO ESTEJA ALUGADO PARA OUTRO USUARIO
            return $this->veiculos->whereDoesntHave('reservas', function (Builder $reserva) use ($inicio, $fim) {
                $reserva->whereRaw("((data_inicio <= '{$inicio}' AND data_fim >= '{$inicio}')
            OR  (data_inicio <= '{$fim}' AND data_fim >= '{$fim}')
            OR  (data_inicio >= '{$inicio}' AND data_fim <= '{$fim}')
            )");
            })->where('ativo', '=', 1)->get();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }

    }

    function relatorioVeiculo($veiculo, $mes)
    {
        $dataInicio = $mes.'-01';
        $dataFim = $mes.'-31';
        try {
            return $this->veiculos->with(['reservas' => function ($reserva) use ($dataInicio, $dataFim) {
                $reserva->where('data_inicio', '>=', $dataInicio)->where('data_fim', '<=', $dataFim);
            }])->where('id', '=', $veiculo)->get();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    function veiculoComReserva($id)
    {
        try {
            return $this->veiculos->whereHas('reservas')->where('id', '=', $id)->first();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}
