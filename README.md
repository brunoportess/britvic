## Passo a passo
OBS: Todos os comandos a serem executados devem ser feitos dentro da pasta do projeto

- Renomeie o arquivo .env.example para .env
- Verifique as variáveis de banco de dados
- Crie o banco de dados com o nome informado na variável
- Execute os comandos a seguir
```
composer install
npm install
npm run prod
php artisan migrate
```


Para alimentar o banco de dados com dados fictícios execute o comando a seguir
```
php artisan db:seed
```

Para executar o projeto, execute o seguinte comando
```
php artisan serve --port=9090
```
Os comandos acima irão instalar as dependências necessárias, criar as tabelas no banco de dados e executar o projeto em http://localhost:9090


## Regras de negócio
- Ao tentar remover um veículo é verificado se possui reserva, caso sim, ele é desativado e não removido.
- Ao efetuar uma reserva deve-se informar primeiramente data início e fim para que seja feito uma busca de veículos que estejam disponíveis de acordo com o período informado

OBS: Não foi utilizado função de validação de CPF no cadastro do usuário para facilitar os testes


## Observações de estrutura
- Foi utilizado o padrão Repository partner;
- As telas de listar relatório, veiculos, usuários e reservas foram feitas usando vueJS e consomem métodos das controllers de API dentro de app\Http\Controllers\Api;
- A tela de criar e editar uma reserva também foi feita em vueJs e consome os métodos das controller de Api como citado anteriormente;
- A tabela é um componente próprio com funções básicas de páginação, busca e ordenação;
- Para validação de campos foi utilizado o recurso VALIDATE do laravel;
- Para evitar repetição de código e reaproveitamento de função foi criado as classes BaseService e BaseRepository que contemplam os métodos básicos de CRUD, sendo sobrescritos somente quando necessário;
- O log é disparado pelo evento de CREATED da model, utilizando Trait.

PS: Não sei se foi a intenção, mas na parte de que um veículo só poderia ser reservado para uma pessoa por vez, implementei data de entrada/saída como esses sites de locadora de veículo, possibilitando outra pessoa alugar o mesmo veículo contando que não conflite com a data de entrada/saída de outra pessoa que já alugou o veículo anteriormente, onde o mesmo não é exibido no SELECT da reserva caso as datas sejam conflitantes

