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
        // VERIFICA SE A DATA DE INICIO OU FIM DE LOCAÇÃO SELECIONADA O VEICULO NAO ESTEJA ALUGADO PARA OUTRO USUARIO
        return $this->veiculos->whereDoesntHave('reservas', function (Builder $reserva) use ($inicio, $fim) {
            $reserva->whereRaw("((data_inicio <= '{$inicio}' AND data_fim >= '{$inicio}')
            OR  (data_inicio <= '{$fim}' AND data_fim >= '{$fim}')
            OR  (data_inicio >= '{$inicio}' AND data_fim <= '{$fim}')
            )");
        })->get();
    }
}
