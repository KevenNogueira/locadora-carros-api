# Locadora de Carros - API 🚗

Este projeto é uma implementação de uma API para uma locadora de carros, que gerencia informações sobre os modelos de carros, locadores e detalhes específicos de cada carro, como quilometragem rodada, cor, placa, entre outros.

## Atributos do Projeto 🛠️

O projeto foi desenvolvido utilizando o framework Laravel e utiliza o banco de dados MySQL. A construção desta API foi orientada pelos conceitos e práticas mais atualizados na criação de uma API Restful. A API oferece suporte aos seguintes verbos HTTP:

-   GET
-   POST
-   PUT
-   PATCH
-   DELETE

Para autenticação, a API faz uso da biblioteca JWT-Auth para a geração de tokens. Os tokens são concedidos após a execução do login, que pode ser realizado na rota:

```
api/login
```

**Observação:** Antes de realizar o login, é necessário cadastrar um usuário no banco de dados.

Após o login bem-sucedido, a API retornará um token que deve ser incluído nas requisições. O token deve ser passado da seguinte forma no header da requisição:

-   Chave: Authorization
-   Valor: Bearer {Token}

Além disso, é necessário incluir a chave Accept no header das requisições, com o valor `application/json`.

## Rotas Autenticadas 🌐

As seguintes rotas da API requerem autenticação, sendo necessário passar o token gerado durante o processo de login para acessá-las:

-   **Carros:** 🚗

    -   <span style="color: #008000;">GET|HEAD</span> /api/v1/carro

    -   <span style="color: #0000ff;">POST</span> /api/v1/carro

    -   <span style="color: #008000;">GET|HEAD</span> /api/v1/carro/{carro}

    -   <span style="color: #ff6600;">PUT|PATCH</span> /api/v1/carro/{carro}

    -   <span style="color: #ff0000;">DELETE</span> /api/v1/carro/{carro}

-   **Clientes:** 👤

    -   <span style="color: #008000;">GET|HEAD</span> /api/v1/cliente

    -   <span style="color: #0000ff;">POST</span> /api/v1/cliente

    -   <span style="color: #008000;">GET|HEAD</span> /api/v1/cliente/{cliente}

    -   <span style="color: #ff6600;">PUT|PATCH</span> /api/v1/cliente/{cliente}

    -   <span style="color: #ff0000;">DELETE</span> /api/v1/cliente/{cliente}

-   **Locações:** 📆

    -   <span style="color: #008000;">GET|HEAD</span> /api/v1/locacao

    -   <span style="color: #0000ff;">POST</span> /api/v1/locacao

    -   <span style="color: #008000;">GET|HEAD</span> /api/v1/locacao/{locacao}

    -   <span style="color: #ff6600;">PUT|PATCH</span> /api/v1/locacao/{locacao}

    -   <span style="color: #ff0000;">DELETE</span> /api/v1/locacao/{locacao}

-   **Marcas:** 🏷️

    -   <span style="color: #008000;">GET|HEAD</span> /api/v1/marca

    -   <span style="color: #0000ff;">POST</span> /api/v1/marca

    -   <span style="color: #008000;">GET|HEAD</span> /api/v1/marca/{marca}

    -   <span style="color: #ff6600;">PUT|PATCH</span> /api/v1/marca/{marca}

    -   <span style="color: #ff0000;">DELETE</span> /api/v1/marca/{marca}

-   **Modelos:** 🚗🏷️

    -   <span style="color: #008000;">GET|HEAD</span> /api/v1/modelo

    -   <span style="color: #0000ff;">POST</span> /api/v1/modelo

    -   <span style="color: #008000;">GET|HEAD</span> /api/v1/modelo/{modelo}

    -   <span style="color: #ff6600;">PUT|PATCH</span> /api/v1/modelo/{modelo}

    -   <span style="color: #ff0000;">DELETE</span> /api/v1/modelo/{modelo}

Essas rotas estão diretamente vinculadas ao token gerado durante o login. É imperativo que um token válido seja passado para que essas rotas funcionem corretamente.

Além disso, há rotas específicas relacionadas à gestão do token:

-   **Token Management:**

    -   <span style="color: #0000ff;">POST</span> /api/v1/logout: Realiza o logout, invalidando o token. 🚪

    -   <span style="color: #0000ff;">POST</span> /api/v1/refresh: Atualiza o token. 🔄

    -   <span style="color: #0000ff;">POST</span> /api/v1/me: Retorna informações do usuário autenticado. 👤

A rota abaixo é utilizada para efetuar o login e gerar o token necessário:

-   **Login: 🔑**

    -   <span style="color: #0000ff;">POST</span> /api/login

⚠️ Certifique-se de incluir o token válido no header das requisições para as rotas autenticadas. ⚠️

## Contribuindo para o Projeto 🤝

Para contribuir com o projeto, siga os passos abaixo:

1. Clonar o projeto:

    ```
    git clone https://github.com/KevenNogueira/locadora-carros-api.git
    ```

2. Gerar o arquivo .ENV:

    ```
    cp .env.example .env
    ```

3. Configurar as variáveis do banco de dados no arquivo .env:

    ```
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=nome_do_seu_banco
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha
    ```

4. Executar as migrations:

    ```
     php artisan migrate
    ```

5. Executar o projeto:

    ```
    php artisan serve
    ```

Agora o projeto estará em execução e pronto para receber contribuições.

---

**Nota:** Certifique-se de ter o PHP e o Composer instalados em seu ambiente antes de executar os comandos acima. Para mais informações sobre o Laravel, consulte a [documentação oficial Laravel 10x](https://laravel.com/docs).
