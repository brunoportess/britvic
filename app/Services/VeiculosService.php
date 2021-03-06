<?php


namespace App\Services;


use App\Repositories\Interfaces\IVeiculosRepository;
use App\Services\Interfaces\IVeiculosService;
use Carbon\Carbon;

class VeiculosService implements IVeiculosService
{
    /**
     * @var IVeiculosRepository
     */
    private $veiculosRepository;

    /**
     * VeiculosService constructor.
     * @param IVeiculosRepository $veiculosRepository
     */
    public function __construct(IVeiculosRepository $veiculosRepository)
    {
        $this->veiculosRepository = $veiculosRepository;
    }

    /**
     * @return mixed
     */
    function listar()
    {
        return $this->veiculosRepository->listar();
    }

    /**
     * @param $id
     * @return mixed
     */
    function listarPorId($id)
    {
        return $this->veiculosRepository->listarPorId($id);
    }

    /**
     * @param $dados
     * @return mixed
     */
    function salvar($dados)
    {
        return $this->veiculosRepository->salvar($dados);
    }

    /**
     * @param $id
     * @param $dados
     * @return mixed
     */
    function atualizar($id, $dados)
    {
        return $this->veiculosRepository->atualizar($id, $dados);
    }

    /**
     * @param $id
     * @return mixed
     */
    function deletar($id)
    {
        // VERIFICA SE O VEICULO TEM RESERVA
        $reserva = $this->veiculosRepository->veiculoComReserva($id);
        // SE O VEICULO TIVER RESERVA ELE SERA DESATIVADO E NAO EXCLUIDO
        if($reserva)
        {
            return $this->veiculosRepository->atualizar($id, ['ativo' => 0]);
        }
        else
        {
            return $this->veiculosRepository->deletar($id);
        }
    }

    /**
     * @param $inicio
     * @param $fim
     * @return mixed
     */
    function listarDisponiveis($inicio, $fim)
    {
        return $this->veiculosRepository->listarDisponiveis($inicio, $fim);
    }

    /**
     * @param $veiculo
     * @param $mes
     * @return array
     * @throws \Exception
     */
    function relatorioVeiculo($veiculo, $mes)
    {
        // INICIA VARIAVEL QUE VAI ARMAZENAR DADOS A SEREM RETORNADOS
        $data = [];
        // VARIAVEIS QUE POSSUEM INICIO E FIM DO MES
        $dataInicio = (new Carbon($mes.'-01'))->firstOfMonth()->toDateString();
        $dataFim = (new Carbon($mes.'-01'))->endOfMonth()->toDateString();
        // BUSCA OS DADOS DE ACORDO COM O FILTRO
        $response = $this->veiculosRepository->relatorioVeiculo($veiculo, $mes);

        // ALIMENTA O ARRAY COM AS DATAS QUE POSSUIR AGENDAMENTO
        foreach($response->toArray() as $item)
        {
            // VERIFICA SE TEM RESERVA PARA PERCORRER O PERIODO
            if(count($item['reservas']) > 0)
            {
                foreach ($item['reservas'] as $reserva)
                {
                    // CRIA REGISTRO DE VEICULO ALUGADO NA FAIXA DE DATA QUANDO FEZ A RESERVA
                    for($x = new Carbon($reserva['data_inicio']); $x <= new Carbon($reserva['data_fim']); $x->addDay())
                    {
                        $dia = $x->format('Y-m-d');
                        $data[$dia] = ['veiculo' => "{$item['marca']} {$item['modelo']} {$item['ano']}", 'dia' => $dia, 'alugado' => 'SIM' ];
                    }
                }
            }

            // CRIAR REGISTRO DE CARRO NAO ALUGADO NOS DEMAIS DIAS QUE ELE NAO FOI ALUGADO
            for($y = new Carbon($dataInicio); $y <= new Carbon($dataFim); $y->addDay())
            {
                $dia = $y->format('Y-m-d');
                // VERIFICA SE O DIA PERCORRIDO NÃO ESTA ALUGADO
                if(!array_key_exists($dia, $data))
                {
                    $data[$dia] = ['veiculo' => "{$item['marca']} {$item['modelo']} {$item['ano']}", 'dia' => $dia, 'alugado' => 'NÃO' ];
                }
            }
        }
        // ORDENA PELA CHAVE (DATA)
        ksort($data);
        return array_values($data);

    }
}
