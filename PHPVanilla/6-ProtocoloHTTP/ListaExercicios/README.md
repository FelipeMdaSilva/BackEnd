### Exercícios Teóricos

1. Numa requisição GET, os dados são armazenados na URL(Query String), enquanto na requisição POST os dados são armazenados de forma oculta no corpo do HTTP por meio de formulários.

2. Pois quando se utiliza uma requisição GET, os dados ficam visíveis na URL:
    - Histórico do navegador: O endereço completo com a senha fica salvo localmente.
    - Logs do servidor web (Access Logs): Servidores (como Apache ou Nginx) registram todas as URLs requisitadas em texto puro.

3. Isso acontece porque a chave $_POST['nome'] ainda não existe quando a página carrega pela primeira vez. Por conta disso, o operador ?? verifica se o valor da variável é null, caso seja, ele atribui um valor vazio("").

4. Uma requisição idempotente é aquela que pode ser executada várias vezes sem alterar o estado do servidor. Usar GET para deletar ou alterar dados é perigoso porque links GET podem ser acessados acidentalmente por robôs de busca ou reexecutados ao recarregar a página, apagando registros do banco de dados sem a intenção do usuário.

5. A afirmação é falsa, pois qualquer validação feita apenas no HTML pode ser facilmente burlada. O usuário pode abrir o inspetor de elementos do navegador e remover os atributos required ou type="email", ou até mesmo enviar dados diretamente para o servidor usando scripts. Por isso, a validação no lado do servidor é obrigatória.

6. O risco de exibir dados do $_POST diretamente na tela é a vulnerabilidade a ataques de XSS, onde um invasor pode enviar códigos JavaScript maliciosos que serão executados no navegador dos usuários. A função htmlspecialchars() evita isso convertendo caracteres especiais em entidades HTML, garantindo que o navegador trate o texto apenas como conteúdo comum e não como código executável.

7. Sticky Forms é a técnica de manter os dados previamente digitados nos campos do formulário caso a página seja recarregada devido a um erro de validação. Isso melhora a experiência do usuário, pois evita que ele tenha o trabalho de preencher todo o formulário denovo do zero.

8. Para confirmar o método de envio, abra a ferramenta do desenvolvedor com F12 e acesse a aba Network. Após submeter o formulário, clique na requisição realizada e observe a seção General dentro de Headers, onde o Request Method deve indicar POST.