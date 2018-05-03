### Ferramentas utilizadas
- Docker 17.05.0-ce
- Docker-Compose: 1.8.0 
- Linux 16.04 LTS
- PHP: 7.1

### Utilizar o Sistema
Se estiver nos conformes dos requerimentos do sistema, vá par ao passo 1.

#### Passo 1. Configurar o Docker e Dependências do Composer
- Executar no terminal:
- docker-compose build
- docker-compose up
- composer install

Se tudo ocorreu bem, vá para o passo 2.

#### Passo 2. Setup do Laravel.
Depois de ativar  os contêiners do Docker com o docker-compose build e docker-compose up.

php artisan key:generate
cp .env.example .env

Configurar o banco de dados de acordo com a senha do docker-compose.yml <br />

php artisan key:generate <br />

Trocar as variáveis
- DB_PORT=33062 - no meu teste utilize a 33062 por que tinha outro contêiner sendo utlizado na porta 3306; <br />
- DB_HOST=127.0.0.1 - default; <br />
- DB_DATABASE=nubetest <br />
- DB_USERNAME=root <br />
= DB_PASSWORD=secret - como definido no docker-compose.yml 

Permissões necessárias: 
- chmod -R 777 storage
- chmod -R 777 bootstrap/cache

Rodar a criação do banco de dados:
- php artisan migrate
- php artisan db:seed --class=SuperHeroSeed

#### Passo 3. Testes unitários
Acessar o docker:
- docker exec -it nubetest_php bash e rodar "./vendor/bin/phpunit" 

#### Passo 4. Teste no Browser
- Criar uma regra no hosts (/etc/hosts - Linux ou C:\Windows\System32\drivers\etc - Windows)
- 127.0.0.1 nubetest.laravel

  

