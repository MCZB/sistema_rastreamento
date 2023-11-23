<?php

namespace Tests\Feature;

use Tests\TestCase;

class EntregaControllerTest extends TestCase
{
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
        // Substitua o CPF abaixo por um CPF válido
        $response = $this->post('/pesquisar', ['cpf' => '62817818059']);
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
        // Substitua a ID abaixo por uma ID que não exista no banco de dados ou na API
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
        // Substitua a ID abaixo por uma ID existente no banco de dados ou na API
        $response = $this->get('/entregas/f1e7be5c-90f3-4b0a-a5ff-3a44941a5412');

        $response->assertViewIs('entregas.detalhes');
        // Adicione mais verificações conforme necessário
    }
}
