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
   Abra o arquivo `.env` e configure as variáveis de ambiente, como o acesso ao banco de dados e as URLs das APIs.

   Exemplo (configuração do banco de dados):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sistema_rastreamento
   DB_USERNAME=seu_usuario
   DB_PASSWORD=sua_senha
   ```
   
5. **Gere a Chave de Aplicação:**
   ```bash
   php artisan key:generate
   ```

6. **Execute as Migrações do Banco de Dados:**
   ```bash
   php artisan migrate
   ```

7. **Inicie o Servidor Local:**
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
- **README.md:** Documentação principal do projeto.

## Funcionalidades do Controlador `EntregaController`

O `EntregaController` possui as seguintes funcionalidades:

### `pesquisarPorCpf(Request $request)`

- Endpoint para pesquisar entregas associadas a um CPF.
- Valida o CPF e retorna uma view correspondente em caso de erro.
- Busca as entregas do cache ou do banco de dados.
- Se não houver entregas, consulta a API de entregas, salva no banco e no cache.
- Retorna a view `entregas.index` com as entregas encontradas.



### `mostrarDetalhes($id)`

- Endpoint para mostrar detalhes de uma entrega por ID.
- Consulta a API de entregas e de transportadoras para obter detalhes da entrega.
- Retorna a view `entregas.detalhes` com os dados da entrega e da transportadora.

### Funções Auxiliares

- `buscarDoCacheOuBanco($cacheKey, $cpf)`: Busca entregas do cache ou do banco de dados.
- `consultarOuAtualizarEntregas($cpf, $cacheKey)`: Consulta a API de entregas, salva no banco e no cache.
- `salvarEntregasNoBanco($entregas)`: Salva entregas no banco, adicionando dados da transportadora.
- `consultarEAdicionarDadosDaTransportadora(&$entrega)`: Consulta API de transportadora e adiciona dados à entrega.
- `consultarApiEntregas($cpf)`: Consulta a API de entregas e filtra as entregas pelo CPF.
- `consultarApiEntregaPorId($id)`: Consulta a API de entregas para obter os detalhes de uma entrega por ID.
- `consultarApiTransportadoraPorId($id)`: Consulta a API de transportadoras para obter detalhes de uma transportadora por ID.

### `validarCPF($cpf)`

- Função para validar se um CPF é válido.

## Importância da Implementação do Cache

A implementação a mais do cache neste projeto desempenha um papel crucial na otimização do desempenho da aplicação. Ao armazenar temporariamente os resultados das consultas no cache, reduzimos a necessidade de acessar o banco de dados ou fazer chamadas à API repetidamente.

Principais benefícios:

1. **Melhoria de Desempenho:** O cache evita consultas desnecessárias ao banco de dados e reduz o tempo de resposta da aplicação.

2. **Redução de Carga no Banco de Dados:** Ao armazenar as entregas no cache, reduzimos a carga no banco de dados, contribuindo para um melhor desempenho geral.

3. **Economia de Recursos:** Menos consultas repetitivas resultam em economia de recursos do servidor, melhorando a escalabilidade da aplicação.

4. **Experiência do Usuário Aprimorada:** Com tempos de resposta mais rápidos, proporcionamos uma experiência mais eficiente e satisfatória para o usuário final.

Em resumo, a implementação do cache é uma prática recomendada para aplicativos que lidam com consultas frequentes a dados estáticos, proporcionando benefícios significativos em termos de desempenho e eficiência.

## Testes

O projeto inclui testes automatizados usando PHPUnit. Para executar os testes, utilize o seguinte comando:

```bash
php artisan test
```

Adapte e expanda os testes de acordo com as necessidades da sua aplicação.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues, propor melhorias ou enviar pull requests.


