# Sistema de Gerenciamento de Entregas

## Descrição

Este projeto Laravel oferece funcionalidades para gerenciar informações de entregas associadas a CPFs específicos. Ele permite a pesquisa por CPF e fornece detalhes sobre as entregas relacionadas.

## Índice

- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Instruções de Instalação](#instruções-de-instalação)
- [Como Usar](#como-usar)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Testes](#testes)
- [Contribuição](#contribuição)
- [Licença](#licença)

## Tecnologias Utilizadas

- [Laravel](https://laravel.com/): Framework PHP para desenvolvimento web.
- [Guzzle](https://docs.guzzlephp.org/en/stable/): Cliente HTTP para interagir com APIs.
- [PHPUnit](https://phpunit.de/): Framework de teste para PHP.
- [API de Entregas](https://run.mocky.io/v3/6334edd3-ad56-427b-8f71-a3a395c5a0c7): API para obter dados de entregas.
- [API de Transportadoras](https://run.mocky.io/v3/e8032a9d-7c4b-4044-9d00-57733a2e2637): API para obter dados das transportadoras.

## Instruções de Instalação

1. **Clone o Repositório:**
   ```bash
   git clone https://github.com/MCZB/sistema-rastreamento.git
   cd sistema-rastreamento
   ```

2. **Instale as Dependências:**
   ```bash
   composer install
   ```

3. **Crie o Arquivo de Configuração do Ambiente:**
   ```bash
   cp .env.example .env
   ```

4. **Configure o Ambiente:**
   Abra o arquivo `.env` e configure as variáveis de ambiente, como banco de dados e URLs da API.

5. **Gere a Chave de Aplicação:**
   ```bash
   php artisan key:generate
   ```

7. **Execute as Migrações do Banco de Dados:**
   ```bash
   php artisan migrate
   ```

8. **Inicie o Servidor Local:**
   ```bash
   php artisan serve
   ```

Acesse [http://localhost:8000/pesquisa](http://localhost:8000/pesquisa) para visualizar a aplicação em execução.

## Como Usar

### Pesquisa por CPF

1. Acesse [http://localhost:8000/pesquisa](http://localhost:8000/pesquisa).
2. Digite um CPF válido na caixa de pesquisa.
3. Clique em "Pesquisar" para visualizar os resultados.

### Detalhes da Entrega

1. Após realizar a pesquisa por CPF, clique no link "Detalhes da Entrega" para obter informações detalhadas sobre uma entrega específica.

## Estrutura do Projeto

A estrutura do projeto segue as convenções padrão do Laravel. Abaixo estão os principais diretórios e arquivos:

- **app:** Contém os controladores, modelos e demais classes da aplicação.
  - `Http/Controllers`: Controladores da aplicação.
  - `Models`: Modelos de dados.
- **database/migrations:** Armazena os arquivos de migração do banco de dados.
- **routes:** Define as rotas da aplicação.
  - `web.php`: Rotas web da aplicação.
- **resources/views:** Contém os arquivos de visualização (Blade) da aplicação.
- **tests:** Inclui os testes automatizados.
  - `Feature/EntregaControllerTest.php`: Testes para o controlador de entrega.
- **.env:** Arquivo de configuração do ambiente.
- **composer.json:** Configuração das dependências do Composer.
- **phpunit.xml:** Configuração do PHPUnit.
- **LICENSE:** Licença do projeto.
- **README.md:** Documentação principal do projeto.

## Testes

O projeto inclui testes automatizados usando PHPUnit. Para executar os testes, utilize o seguinte comando:

```bash
php artisan test
```

Adapte e expanda os testes de acordo com as necessidades da sua aplicação.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues, propor melhorias ou enviar pull requests.

## Licença

Este projeto está sob a licença [MIT](LICENSE).
```
