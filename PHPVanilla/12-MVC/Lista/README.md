
1.
Misturar tudo (HTML, SQL e validações) num arquivo só deixa o sistema impossível de manter. Se você quiser mudar a cor de um botão no HTML, corre o risco de quebrar o acesso ao banco de dados por acidente. Além disso, fica ruim de reaproveitar o código e duas pessoas não conseguem mexer no projeto ao mesmo tempo sem dar conflito.

2.
• Model: Cuida dos dados e do banco. É aqui que ficam as regras do negócio (como calcular descontos ou validar um cadastro).
• View: É a tela, o visual que o usuário enxerga (HTML/CSS).
• Controller: O intermediário. Ele recebe o clique do usuário, pede as informações para o Model e manda para a View exibir na tela.

3.
• composer.json: É a lista de compras (diz quais pacotes o seu projeto precisa).
• composer.lock: É o cupom fiscal detalhado (guarda a versão exata que foi instalada, para que o projeto rode igual no computador de todo mundo).
• Pasta vendor/ fora do Git: Essa pasta guarda os arquivos pesados que o Composer baixou. Não faz sentido enviar ela para o Git porque qualquer desenvolvedor pode recriá-la idêntica apenas digitando o comando composer install.

4.
É uma regra de organização. Ela diz que o nome das pastas deve ser idêntico ao "caminho" (namespace) do código. Se o PHP procura por App\Controllers\ProdutoController, o sistema olha no mapa, troca App por src e acha o arquivo direto na pasta src/Controllers/ProdutoController.php.

5.
A principal vantagem é a segurança por isolamento, pois o usuário na internet só consegue enxergar a pasta public/. Como o código principal do sistema fica guardado do lado de fora dessa pasta, um invasor não consegue acessar seus arquivos de configuração ou senhas diretamente pelo navegador.

6.
O roteador olha duas coisas que vêm na requisição: a URL (o endereço escrito) e o Verbo HTTP (se é um envio ou um acesso).
• Se for GET /produtos, ele sabe que é para listar os produtos na tela.
• Se for POST /produtos, ele sabe que o usuário enviou um formulário para salvar um novo produto.

7.
A função extract() pega um array (como ['nome' => 'João']) e transforma as chaves em variáveis de verdade (virando $nome = 'João'). O Controller faz isso logo antes de carregar a tela (View), fazendo com que os dados fiquem disponíveis para serem exibidos no HTML facilmente.

8.
O htmlspecialchars() serve para desarmar códigos maliciosos. Se um usuário mal-intencionado digitar um código de vírus (como <script>) em um formulário, essa função transforma o texto em algo inofensivo na tela, impedindo que o navegador execute o vírus e roube dados de outras pessoas.

9. 
O Controller serve apenas para direcionar o trânsito do sistema. Se ele começar a fazer conexões com o banco (new PDO) ou montar comandos SQL na força bruta, o código fica amarrado, inseguro (fácil de sofrer ataques) e difícil de testar. Essa parte suja de banco de dados deve ficar só no Model.

10.
O Laravel 11 funciona exatamente igual a esse MVC artesanal, só que já vem pronto:
• A pasta pública dele usa o mesmo conceito de Front Controller.
• O arquivo de rotas dele faz o papel do Roteador HTTP.
• Ele usa o Composer e PSR-4 para organizar os arquivos.
• O motor de telas dele (Blade) já limpa o texto automaticamente contra XSS usando {{ }} por baixo dos panos.