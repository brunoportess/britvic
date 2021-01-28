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

    /**
     * VeiculosRepository constructor.
     * @param Veiculo $veiculos
     */
    public function __construct(Veiculo $veiculos)
    {
        parent::__construct($veiculos);
        $this->veiculos = $veiculos;
    }

    /**
     * @param $inicio
     * @param $fim
     * @return mixed
     * @throws \Exception
     */
    function listarDisponiveis($inicio, $fim)
    {
        try {
            // VERIFICA SE A DATA DE INICIO OU FIM DE LOCAÇÃO SELECIONADA, O VEICULO NAO ESTEJA ALUGADO PARA OUTRO USUARIO
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

    /**
     * @param $veiculo
     * @param $mes
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     * @throws \Exception
     */
    function relatorioVeiculo($veiculo, $mes)
    {
        // PEGA DIA INICIO/FIM DO MES INFORMADO
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

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    function veiculoComReserva($id)
    {
        try {
            // RETORNA SOMENTE SE O VEICULO POSSUIR RESERVA
            return $this->veiculos->whereHas('reservas')->where('id', '=', $id)->first();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}
