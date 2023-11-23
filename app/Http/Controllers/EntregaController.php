<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use App\Models\Entrega;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class EntregaController extends Controller
{
    private const CACHE_PREFIX = 'entregas_';
    private const API_ENTREGAS_URL = 'https://run.mocky.io/v3/6334edd3-ad56-427b-8f71-a3a395c5a0c7';
    private const API_TRANSPORTADORA_URL = 'https://run.mocky.io/v3/e8032a9d-7c4b-4044-9d00-57733a2e2637';

    private $httpClient;

    public function __construct(GuzzleClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function pesquisarPorCpf(Request $request)
    {
        try {
            $cpf = $request->input('cpf');

            // Validar CPF (chamada corrigida)
            if (!$this->validarCPF($cpf)) {
                // Trate como um CPF inválido
                return view('entregas.cpf_invalido');
            }

            $cacheKey = self::CACHE_PREFIX . $cpf;

            $entregas = $this->buscarDoCacheOuBanco($cacheKey, $cpf);

            if ($entregas->isEmpty()) {
                $entregas = $this->consultarOuAtualizarEntregas($cpf, $cacheKey);

                if ($entregas->isEmpty()) {
                    return view('entregas.nenhuma_entrega');
                }
            }

            return view('entregas.index', compact('entregas'));
        } catch (\Exception $e) {
            Log::error('Erro ao pesquisar por CPF: ' . $e->getMessage());
            return view('cpf_invalido');
        }
    }

    public function mostrarDetalhes($id)
    {
        try {
            $entrega = $this->consultarApiEntregaPorId($id);
            $transportadora = $this->consultarApiTransportadoraPorId($entrega['_id_transportadora']);

            return view('entregas.detalhes', compact('entrega', 'transportadora'));
        } catch (\Exception $e) {
            Log::error('Erro ao mostrar detalhes da entrega: ' . $e->getMessage());
            return view('entregas.id_invalido');
        }
    }

    private function buscarDoCacheOuBanco($cacheKey, $cpf)
    {
        if (Cache::has($cacheKey)) {
            return collect(Cache::get($cacheKey));
        }

        $entregas = Entrega::getEntregasByCpf($cpf);

        if (!$entregas->isEmpty()) {
            Cache::put($cacheKey, $entregas->toArray(), 60);
        }

        return $entregas;
    }

    private function consultarOuAtualizarEntregas($cpf, $cacheKey)
    {
        $entregas = $this->consultarApiEntregas($cpf);

        if (!empty($entregas)) {
            $this->salvarEntregasNoBanco($entregas);
            Cache::put($cacheKey, $entregas, 60);
        }

        return collect($entregas);
    }

    private function salvarEntregasNoBanco($entregas)
    {
        foreach ($entregas as $entrega) {
            $existingEntrega = Entrega::where('_id', $entrega['_id'])->first();

            if (!$existingEntrega) {
                $this->consultarEAdicionarDadosDaTransportadora($entrega);
                Entrega::saveEntregaData($entrega);
            }
        }
    }

    private function consultarEAdicionarDadosDaTransportadora(&$entrega)
    {
        $transportadora = $this->consultarApiTransportadoraPorId($entrega['_id_transportadora']);
        $entrega['_cnpj'] = $transportadora['_cnpj'];
        $entrega['_fantasia'] = $transportadora['_fantasia'];
    }

    private function consultarApiEntregas($cpf)
    {
        $response = $this->httpClient->get(self::API_ENTREGAS_URL);
        $data = json_decode($response->getBody(), true);

        $entregas = collect($data['data'])->filter(function ($entrega) use ($cpf) {
            // Valide os dados da entrega, se necessário
            return $entrega['_destinatario']['_cpf'] === $cpf;
        })->all();

        return $entregas;
    }

    private function consultarApiEntregaPorId($id)
    {
        $response = $this->httpClient->get(self::API_ENTREGAS_URL);
        $data = json_decode($response->getBody(), true);

        $entrega = collect($data['data'])->firstWhere('_id', $id);

        return $entrega;
    }

    private function consultarApiTransportadoraPorId($id)
    {
        $response = $this->httpClient->get(self::API_TRANSPORTADORA_URL);
        $data = json_decode($response->getBody(), true);

        $transportadora = collect($data['data'])->firstWhere('_id', $id);

        return $transportadora;
    }

    function validarCPF($cpf) {
        // Remover caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
        // Verificar se o CPF possui 11 dígitos
        if (strlen($cpf) !== 11) {
            return false;
        }
    
        // Verificar se todos os dígitos são iguais, o que torna o CPF inválido
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
    
        // Calcular e verificar o primeiro dígito verificador
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += intval($cpf[$i]) * (10 - $i);
        }
        $remainder = $sum % 11;
        $digit1 = ($remainder < 2) ? 0 : 11 - $remainder;
    
        if (intval($cpf[9]) !== $digit1) {
            return false;
        }
    
        // Calcular e verificar o segundo dígito verificador
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += intval($cpf[$i]) * (11 - $i);
        }
        $remainder = $sum % 11;
        $digit2 = ($remainder < 2) ? 0 : 11 - $remainder;
    
        if (intval($cpf[10]) !== $digit2) {
            return false;
        }
    
        return true;
    }
}    
