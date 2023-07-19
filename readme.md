# Projeto Docker Compose com PHP, MySQL, PostgreSQL, Redis e MongoDB

Este projeto é um exemplo de configuração do Docker Compose para executar uma aplicação PHP com bancos de dados MySQL, PostgreSQL, Redis e MongoDB.

## Pré-requisitos

- Docker
- Docker Compose


## Estrutura do projeto
```bash
meu_projeto/
|-- docker-compose.yml
|-- Dockerfile
|-- app/
|   |-- index.php
|-- config/
|   |-- php.ini
|-- logs/
|   |-- php/
|   |-- mysql/
|   |-- postgres/
|   |-- mongo/
|   |-- redis/
|-- vhost/
|   |-- meu_projeto.conf
|-- mysql-data/
|-- postgres-data/
|-- mongo-data/
|-- redis-data/
|-- README.md
```
docker-compose.yml: Arquivo de configuração do Docker Compose que define os serviços e suas configurações.
Dockerfile: Arquivo de configuração do Docker que define como construir a imagem do contêiner PHP com Apache e suas extensões.
app/: Diretório que contém os arquivos da aplicação PHP.
app/index.php: Arquivo PHP que contém o código da aplicação.
config/: Diretório que contém o arquivo php.ini personalizado para o PHP.
logs/: Diretório que contém os logs dos diferentes serviços.
logs/php/: Diretório para os logs do PHP.
logs/mysql/: Diretório para os logs do MySQL.
logs/postgres/: Diretório para os logs do PostgreSQL.
logs/mongo/: Diretório para os logs do MongoDB.
logs/redis/: Diretório para os logs do Redis.
vhost/: Diretório que contém as configurações de hosts virtuais do Apache.
vhost/meu_projeto.conf: Arquivo de configuração do Apache para o host virtual da aplicação.
mysql-data/: Diretório para persistir os dados do MySQL.
postgres-data/: Diretório para persistir os dados do PostgreSQL.
mongo-data/: Diretório para persistir os dados do MongoDB.
redis-data/: Diretório para persistir os dados do Redis.
README.md: Arquivo de documentação do projeto.


## Instruções de execução

1. Crie um diretório para o seu projeto e coloque os arquivos `docker-compose.yml`, `Dockerfile` e o arquivo PHP (`index.php`) fornecidos neste repositório.

2. Crie um diretório chamado `config` e coloque o arquivo `php.ini` personalizado dentro dele. O arquivo `php.ini` é usado para configurar as extensões PHP.

3. Crie os seguintes diretórios na raiz do projeto:
   - `app`: Onde você colocará os arquivos PHP da sua aplicação.
   - `logs`: Para armazenar os logs dos serviços.
   - `vhost`: Onde você pode colocar os arquivos de configuração do VirtualHost do Apache (opcional).
   - `mysql-data`, `postgres-data`, `mongo-data`, e `redis-data`: Diretórios para armazenar os dados dos bancos de dados.

4. Dentro do diretório `app`, coloque o arquivo PHP `index.php` fornecido neste repositório. Este arquivo contém um código simples que faz testes de conexão com os bancos de dados configurados.

5. Abra o terminal na pasta do projeto onde estão os arquivos `docker-compose.yml` e `Dockerfile`.

6. Execute o seguinte comando para criar e iniciar os contêineres:

```bash
docker-compose up -d
```

Para alterar a versão do PHP no projeto Docker Compose, você precisará fazer algumas modificações no arquivo docker-compose.yml e no arquivo Dockerfile.

No arquivo docker-compose.yml, você pode ver que a versão do PHP é definida como uma variável de argumento PHP_VERSION. Essa variável é passada para o Dockerfile durante o processo de construção do contêiner PHP. Para alterar a versão do PHP, basta alterar o valor da variável PHP_VERSION no arquivo docker-compose.yml para a versão desejada. Por exemplo, se você deseja usar o PHP 8.0, você pode alterar a linha:

```bash
args:
  - PHP_VERSION=7.4
```
Para:

```bash
args:
  - PHP_VERSION=8.0
```  
Isso indicará ao Docker para usar a versão do PHP 8.0 ao construir o contêiner.

No arquivo Dockerfile, você pode ver a imagem base do PHP sendo definida com a tag 7.4-apache:

```bash
# Dockerfile
FROM php:7.4-apache
```

Para alterar a versão do PHP nesse arquivo, você deve alterar a tag 7.4-apache para a versão desejada. Por exemplo, para usar o PHP 8.0 com o Apache, você pode alterar para:

```bash
# Dockerfile
FROM php:8.0-apache
```
# Restante do conteúdo do Dockerfile...
Depois de fazer essas alterações, você pode recriar os contêineres usando o comando 'docker-compose up -d' para que eles sejam construídos com a nova versão do PHP. Certifique-se de que a nova versão do PHP esteja disponível como uma imagem no Docker Hub ou em um registro de contêineres que você tenha acesso.

Lembre-se de que ao alterar a versão do PHP, algumas extensões ou configurações específicas podem ser diferentes entre as versões. Verifique a documentação oficial do PHP para obter mais informações sobre as alterações introduzidas em diferentes versões.