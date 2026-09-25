## Exercicios Teóricos

1. Abstração de Dados
O PDO (PHP Data Objects) é uma interface de abstração de acesso a dados no PHP. Ele permite interagir com diversos bancos de dados usando a mesma interface de métodos, sem mudar a regra de negócio. Em projetos corporativos, é preferível ao pgsql por ser orientado a objetos, oferecer suporte nativo a Prepared Statements contra SQL Injection e facilitar a migração ou suporte a múltiplos SGBDs.

2. Ciclo do DSN
A DSN (Data Source Name) é a string que carrega as configurações de conexão para o driver do PDO.
host: Endereço do servidor onde o banco está rodando (ex: 127.0.0.1 ou localhost).
port: Porta de rede em que o serviço do PostgreSQL escuta conexões (ex: 5432).
dbname: Nome do banco de dados específico ao qual o sistema vai se conectar.

3. Padrão de Portas
A porta padrão do PostgreSQL é a 5432. Ela é referenciada dentro da string DSN no parâmetro "port", logo após o host:
pgsql:host=localhost;port=5432;dbname=meu_banco

4. Flags de Integridade
Com PDO::ERRMODE_EXCEPTION, o PDO passa a lançar exceções do tipo PDOException sempre que ocorre um erro de SQL ou conexão, permitindo tratar falhas com blocos try-catch sem parar a execução de forma brusca. Caso a flag não seja definida, o comportamento padrão é o silencioso (PDO::ERRMODE_SILENT), onde os erros não geram exceções nem interrompem o script, apenas alimentando códigos de erro internos que precisam ser checados manualmente.

5. Fetch Mode
A vantagem de PDO::FETCH_ASSOC é instruir o PDO a retornar as consultas apenas como um array associativo (com as colunas como chaves). O modo padrão (FETCH_BOTH) duplica os dados ao trazer chaves numéricas e associativas simultaneamente. Usar FETCH_ASSOC economiza memória RAM no servidor ao evitar a criação dessa estrutura duplicada em memória.

6. Padrão Singleton
Cada instância do PDO cria uma conexão de rede via socket TCP dedicada com o PostgreSQL. O servidor do banco possui um limite máximo de conexões simultâneas (max_connections). Se cada consulta instanciar um new PDO(), o limite de conexões será atingido rapidamente, esgotando os recursos do PostgreSQL e derrubando novas tentativas de acesso.

7. Encapsulamento do Singleton
O construtor precisa ser private para impedir que a classe seja instanciada com "new" fora dela, garantindo que o ponto de entrada seja apenas o método estático de controle. Os métodos mágicos __clone() e __wakeup() devem ser bloqueados (declarados como privados ou lançando exceção) para evitar que a instância seja clonada ou desserializada, garantindo a existência de uma única conexão no ciclo da requisição.

8. Segurança de Credenciais
Salvar credenciais de forma estática (hardcoded) no código expõe usuário e senha em repositórios de código e históricos de versão (como o Git). O correto é usar arquivos de configuração externos (.ini ou .env) que fiquem fora do versionamento via .gitignore, mantendo os dados sensíveis isolados do ambiente de desenvolvimento/repositório.

9. Tratamento de Exceções & LGPD
Exibir $e->getMessage() na tela do navegador causa a vulnerabilidade de Information Disclosure (divulgação de informações), expondo detalhes internos da infraestrutura (IPs, nomes de tabelas, estrutura de banco e usuários). Sob a LGPD, isso viola os princípios de segurança da informação ao expor potenciais vetores de ataque. O correto é salvar a mensagem de erro detalhada em logs internos do servidor e exibir apenas uma mensagem genérica de erro amigável ao usuário final.