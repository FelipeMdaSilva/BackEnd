# Exercicios téoricos

1. O protocolo HTTP é stateless. Isso quer dizer que o ele trata cada requisição de forma isolada, como se fosse a primeira vez que ele estivesse interagindo com o usuário do sistema. Os cookies são necessários para fazer a aplicação lembrar do usuário, assim facilitando a usabilidade do mesmo, pois os dados ficam guardados.

2. Os dados armazenados em um cookie são armazenados no navegador do cliente, enquanto os dados armazenados na superglobal são armazenados diretamente no servidor. A superglobal apresenta uma maior segurança para informações confidenciais, pois como os dados ficam salvos no servidor, o usuário/cliente não consegue visualizar nem alterar o conteúdo do arquivo de sessão diretamente. Outro ponto é que quando utiliza cookies, ele pode ser facilmente manipulado pelo Devtools.

3. A configuração `httponly => true` instrui o navegador a proibir totalmente que scripts do lado do cliente (como JavaScript, via `document.cookie`) acessem o cookie de sessão. Dessa forma, mesmo que uma aplicação contenha uma vulnerabilidade de Cross-Site Scripting (XSS) e um atacante consiga injetar código malicioso na página, o script não terá permissão para ler o cookie que armazena o ID da sessão, impedindo o roubo desse identificador e, consequentemente, evitando o sequestro de sessão (Session Hijacking).

4. O atributo `SameSite=Lax` tem a finalidade de restringir o envio automático de cookies em requisições feitas a partir de sites de terceiros, liberando o cookie apenas em navegações seguras e diretas (como ao clicar em um link comum). Essa configuração atua diretamente na prevenção de ataques de CSRF (Cross-Site Request Forgery), pois impede que um site malicioso force o navegador da vítima a realizar ações indesejadas em outra aplicação aproveitando-se de uma sessão ativa, já que o cookie de autenticação não será enviado na requisição forçada.

