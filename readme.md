# HSS RENTAL

Bem-vindo à documentação da HSS RENTAL - sua solução de locação de veículos desenvolvida com Laravel 10. Esta aplicação oferece uma plataforma fácil de usar para clientes (CUSTOMER) se cadastrarem, escolherem veículos, e efetuarem locações, enquanto os funcionários (COMMOM) gerenciam e confirmam as locações. Os administradores (ADMIN) têm permissões adicionais para gerenciar usuários, veículos e outras configurações.

**Conheça a HSS RENTAL:** [Acesse](https://hssrental.netlify.app)

## Funcionalidades Principais

1. **Cadastro e Locação de Veículos:**
   - Os clientes (CUSTOMER) podem se cadastrar na plataforma e escolher veículos para locação, especificando as datas de retirada e devolução.
   - O sistema notificará os clientes quando as locações forem confirmadas pelos funcionários (COMMOM), via e-mail e notificação push.

2. **Permissões de Usuários:**
   - **CUSTOMER:** Pode realizar locações e visualizar seu histórico de locações.
   - **COMMOM:** Funcionário sem permissões administrativas, confirma locações e verifica o histórico geral de locações.
   - **ADMIN:** Tem todas as permissões do COMMOM e pode listar, editar e cadastrar usuários e veículos.

3. **Disponibilidade de Veículos:**
   - O sistema garante que apenas veículos disponíveis na data escolhida estejam disponíveis para locação, evitando conflitos de reservas.

4. **Notificações e Promoções:**
   - Os clientes recebem notificações push e e-mails para locações confirmadas, além de promoções e avisos programados pela equipe de marketing.

## Como Rodar o Projeto

**LEMBRE-SE DE CONFIGURAR O PROJETO FRONTEND:** [REPOSITÓRIO](https://hssrental.netlify.app)

### Sem Docker

1. Clone o projeto e acesse a pasta `APP`.
2. Execute o comando `composer install`.
3. Copie o arquivo `.env.example` e renomeie para `.env`.
4. Execute o comando `php artisan key:generate`.
5. Execute o comando `php artisan jwt:secret`.
6. Para notificações de logs, configure a variável de ambiente `LOG_DISCORD_WEBHOOK_URL` com seu webhook.
7. Para notificações push do FIREBASE, configure a variável de ambiente `FCM_SERVER_TOKEN`.
8. Para e-mails, configure as variáveis de ambiente com as informações do seu SMTP.

### Com Docker

Partindo do princípio que você já possui o Docker e Docker Compose configurados na sua máquina:

1. Faça o clone do projeto.
2. Na raiz do projeto, execute o build da imagem executando: `docker-compose build`.
3. Você pode executar o comando `docker-compose up -d` ou executar o script sh da raiz `START`.
4. A aplicação irá rodar na porta 8000 com MySQL e Redis já configurados. Lembre-se de ajustar o seu `.env` com as configurações corretas, principalmente o host do Redis que deve ser alterado de `127.0.0.1` para `"redis"`.


Em ambos os casos lembre de rodar os comandos  `php artisan migrate` e  `php artisan db:seed` 
