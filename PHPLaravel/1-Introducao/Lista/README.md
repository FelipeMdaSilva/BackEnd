1. **Construir um MVC artesanal** ensina o funcionamento básico de uma requisição HTTP, o roteamento e a separação de responsabilidades (dados, interface e lógica). Isso torna o uso do Laravel mais compreensível e baseado em fundamentos sólidos.

2. **O Laravel 11** simplificou a estrutura padrão e reduziu arquivos de configuração. O arquivo `bootstrap/app.php` passou a centralizar a inicialização da aplicação, o registro de middlewares e o tratamento de exceções.

3. Gravar credenciais de banco de dados diretamente no `config/database.php**` viola a separação entre código e configuração e compromete a segurança, já que o arquivo é versionado no Git.

4. **Alterar a `APP_KEY` em ambiente de produção** corrompe dados criptografados armazenados e invalida todas as sessões ativas de usuários, gerando erros de descriptografia.

5. **Apontar o servidor web para a raiz do projeto** expõe arquivos confidenciais (como o `.env` e chaves de API) e o código-fonte. O diretório público deve ser restrito exclusivamente à pasta `public` e ao seu arquivo `index.php`.

6. **Scripts PHP procedurais** executados de forma isolada não possuem acesso ao contexto do framework. O comando `php artisan` inicializa o ecossistema do Laravel, disponibilizando conexões, variáveis de ambiente, filas e cache.

7. O arquivo `.env.example**` atua como um modelo para indicar quais variáveis de ambiente são necessárias para a aplicação, permitindo que novos desenvolvedores configurem seus ambientes locais sem expor dados reais no controle de versão.

8. A diretiva `{{ $variavel }}**` realiza o escape automático de caracteres HTML para prevenir ataques de XSS. A diretiva `{!! $variavel !!}` renderiza o conteúdo sem tratamento, expondo a aplicação a riscos de segurança se a entrada não for confiável.

9. **Manter controllers enxutos** atende ao Princípio da Responsabilidade Única, facilita os testes unitários e viabiliza o reaproveitamento da lógica de negócios em diferentes contextos (Web, API ou CLI).

10. O comando `php artisan tinker**` fornece um ambiente de linha de comando interativo com o ecossistema do Laravel carregado, permitindo testar consultas do Eloquent e serviços diretamente, sem necessidade de rotas ou requisições HTTP manuais.