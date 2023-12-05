<?php

namespace Tests\Feature;

use Tests\TestCase;

class EntregaControllerTest extends TestCase
{
    private $cpfValido;
    private $idValida;

    public function setUp(): void
    {
        parent::setUp();

        // Configurar dados de teste
        $this->cpfValido = '62817818059';
        $this->idValida = 'f1e7be5c-90f3-4b0a-a5ff-3a44941a5412';
    }

    /**
     * Testa a pesquisa por CPF com um CPF inválido.
     *
     * @return void
     */
    public function testPesquisaPorCpfComCpfInvalido()
    {
        $response = $this->post('/pesquisar', ['cpf' => '12345678900']);
        $response->assertViewIs('cpf_invalido');
    }

    /**
     * Testa a pesquisa por CPF com um CPF válido.
     *
     * @return void
     */
    public function testPesquisaPorCpfComCpfValido()
    {
        // Use $this->cpfValido aqui
        $response = $this->post('/pesquisar', ['cpf' => $this->cpfValido]);
        $response->assertViewIs('entregas.index');
        // Adicione mais verificações conforme necessário
    }

    /**
     * Testa a exibição de detalhes de entrega com uma ID inválida.
     *
     * @return void
     */
    public function testMostrarDetalhesComIdInvalida()
    {
        // Use uma ID dinâmica que seja improvável de existir
        $response = $this->get('/entregas/999');
        $response->assertViewIs('entregas.id_invalido');
        // Adicione mais verificações conforme necessário
    }

    /**
     * Testa a exibição de detalhes de entrega com uma ID válida.
     *
     * @return void
     */
    public function testMostrarDetalhesComIdValida()
    {
        // Use $this->idValida aqui
        $response = $this->get('/entregas/' . $this->idValida);
        $response->assertViewIs('entregas.detalhes');
        // Adicione mais verificações conforme necessário
    }

    public function tearDown(): void
    {
        // Limpar dados de teste, se necessário
        parent::tearDown();
    }
}