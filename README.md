## Setup

Siga as intruções abaixo para executar o projeto

Clone Repositório da aplicação
```sh
git clone 
```

```sh
cd laravel-app/
```

Clone Repositório do laradock
```sh
git clone 
```

Gere o .env do projeto, ajuste os parametros se for necessário
```sh
cp .env.example .env
```

Gere o .env do laradock
```sh
cp .env.laradock laradock/.env
```

Entre no diretório do laradock
```sh
cd laradock/
```

Execute o docker-compose
```sh
docker-compose up -d nginx mysql php-fpm redis php-worker --build
```

Entre no container da aplicação
```sh
docker-compose exec workspace bash
```

Instale as dependências
```sh
composer install
```

Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Crie as tabelas
```sh
php artisan migrate
```
```sh
php artisan module:migrate EventScheduler
```

Acessar o projeto
[http://localhost](http://localhost)

### Testes

Executar testes
```sh
touch database/database.sqlite
```
```sh
php artisan test
```