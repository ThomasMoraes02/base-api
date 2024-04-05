# Base Web Project

Bem-vindo ao Base Web Project, um ambiente de desenvolvimento robusto, projetado para facilitar o desenvolvimento e o teste de aplicações web. Este projeto utiliza Docker Compose para orquestrar múltiplos contêineres, incluindo PHP 8.2 com Xdebug, Nginx como servidor web, e MySQL como banco de dados, tudo isso sobre a base do micro-framework Slim v4.

## 📦 Estrutura do Projeto

O projeto está estruturado da seguinte maneira:

- `docker/`: Diretório contendo todas as configurações do Docker necessárias para os serviços web, app, database e phpmyadmin.
- `.env.copy`: Template para o arquivo de variáveis de ambiente. Deve ser copiado para `.env` e preenchido conforme necessário.

## 🚀 Início Rápido

Para começar a usar o Base Web Project, siga estas etapas:

### Pré-requisitos

- Docker e Docker Compose instalados na sua máquina.
- Cópia e configuração do arquivo `.env` a partir do `.env.copy`.

### Configuração

1. **Prepare o arquivo `.env`**:

    Copie o arquivo `.env.copy` para `.env`:

    ```bash
    cp .env.copy .env
    ```

    Preencha o arquivo `.env` com suas configurações específicas, como portas e credenciais do banco de dados.

2. **Construa e inicie os contêineres**:

    Execute o seguinte comando para construir e iniciar os contêineres:

    ```bash
    docker-compose up -d --build
    ```

## 🔗 Acessando os Serviços

- **Nginx (Servidor Web)**: Acesse via `http://localhost:<WEBSERVER_PORT>`, substituindo `<WEBSERVER_PORT>` pela porta definida no arquivo `.env`.
- **PHPMyAdmin**: Gerencie o banco de dados MySQL acessando `http://localhost:<PHPMYADMIN_PORT>`.
- **MySQL (Banco de Dados)**: Conecte-se ao banco de dados utilizando a porta e credenciais definidas no arquivo `.env`.

## 🧪 Executando Testes

Para executar testes no seu projeto, utilize os seguintes comandos:

- **Pest**:

    ```bash
    vendor/bin/pest tests --colors
    ```

- **PHPUnit**:

    ```bash
    vendor/bin/phpunit
    ```

## 🤝 Contribuindo

Contribuições são sempre bem-vindas! Para contribuir, por favor, faça um fork do repositório, crie uma branch para suas modificações e submeta um pull request.

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
