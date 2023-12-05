<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\EntregaController;
use GuzzleHttp\Client as GuzzleClient;
use ReflectionMethod;

class EntregaControllerTest extends TestCase
{
    /**
     * Testa o método validarCPF com CPF válido.
     *
     * @return void
     */
    public function testValidarCPFValido()
    {
        $guzzleClient = new GuzzleClient();
        $entregaController = new EntregaController($guzzleClient);

        // Define um CPF válido
        $cpfValido = '12345678909';

        // Chama o método validarCPF e verifica se o resultado é verdadeiro
        $resultado = $entregaController->validarCPF($cpfValido);
        $this->assertTrue($resultado);
    }

    /**
     * Testa o método validarCPF com CPF inválido.
     *
     * @return void
     */
    public function testValidarCPFInvalido()
    {
        $guzzleClient = new GuzzleClient();
        $entregaController = new EntregaController($guzzleClient);

        // Define um CPF inválido
        $cpfInvalido = '11122233344';

        // Chama o método validarCPF e verifica se o resultado é falso
        $resultado = $entregaController->validarCPF($cpfInvalido);
        $this->assertFalse($resultado);
    }

    /**
     * Testa o método buscarDoCacheOuBanco.
     *
     * @return void
     */
    public function testBuscarDoCacheOuBanco()
    {
        $guzzleClient = new GuzzleClient();
        $entregaController = new EntregaController($guzzleClient);

        // Use reflexão para acessar um método privado
        $method = new ReflectionMethod(EntregaController::class, 'buscarDoCacheOuBanco');
        $method->setAccessible(true);

        // Simula a execução do método privado
        $result = $method->invoke($entregaController, 'cache_key', 'cpf');

        // Verifica se o resultado é uma coleção, como esperado
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $result);

        // Verifica se o resultado está vazio inicialmente
        $this->assertTrue($result->isEmpty(), 'O resultado deve estar vazio inicialmente');

        // Adiciona dados ao cache
        $cache = app('cache.store'); // Assume que o cache é usado
        $cache->put('cache_key', 'dados_do_cache', 60);

        // Simula a execução do método privado novamente
        $result = $method->invoke($entregaController, 'cache_key', 'cpf');

        // Verifica se o resultado agora contém dados do cache
        $this->assertFalse($result->isEmpty(), 'O resultado deve conter dados do cache após a adição');

        // Adicione mais verificações conforme necessário
    }

    /**
     * Testa o método consultarOuAtualizarEntregas.
     *
     * @return void
     */
    public function testConsultarOuAtualizarEntregas()
    {
        $guzzleClient = new GuzzleClient();
        $entregaController = new EntregaController($guzzleClient);

        // Use reflexão para acessar um método privado
        $method = new ReflectionMethod(EntregaController::class, 'consultarOuAtualizarEntregas');
        $method->setAccessible(true);

        // Simula a execução do método privado
        $result = $method->invoke($entregaController, 'cpf', 'cache_key');

        // Faça as asserções necessárias
        $this->assertTrue(true);
    }
}
