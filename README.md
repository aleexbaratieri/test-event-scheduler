## Setup

Siga as intruções abaixo para executar o projeto

Clone Repositório da aplicação
```sh
git clone git@github.com:aleexbaratieri/test-event-scheduler.git laravel-app
```

```sh
cd laravel-app/
```

Adicione o Repositório do laradock
```sh
git submodule add https://github.com/Laradock/laradock.git laradock
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

Crie o arquivo do Supervisor para o php-worker
```sh
cd php-worker/
```
```sh
cd supervisord.d/
```
```sh
mv laravel-worker.conf.example laravel-worker.conf
```

Edite o arquivo `laravel-worker.conf` com o seguinte código
```sh
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/artisan queue:work --sleep=3 --tries=3 --daemon
autostart=true
autorestart=true
numprocs=2
user=laradock
redirect_stderr=true
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

### Http File
```
events.http
```