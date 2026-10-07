1. Definição de CRUD
O acrônimo significa Create, Read, Update e Delete. A correspondência direta com as instruções SQL no PostgreSQL é:
Create - INSERT
Read - SELECT
Update - UPDATE
Delete - DELETE

2. Anatomia do SQL Injection
Quando o código junta texto comum com variáveis vindas de GET ou POST, o banco de dados não consegue diferenciar o que é instrução do programa e o que é dado enviado pelo usuário. Se um atacante digita caracteres especiais como aspas simples seguidas de comandos SQL, ele quebra a estrutura original da consulta e consegue inserir novos comandos para alterar a lógica de busca ou autenticação.

3. Mecanismo das Prepared Statements
Na primeira etapa, chamada prepare, a estrutura da consulta SQL é enviada ao banco para ser analisada e compilada em um plano fixo. Na segunda etapa, no execute, os dados do usuário são enviados separadamente. Como a estrutura da consulta já foi definida na primeira etapa, o banco trata tudo o que chega depois puramente como dado ou texto, sem interpretar qualquer caractere como comando SQL.

4. Marcadores Nomeados
A principal vantagem é a clareza e a facilidade de manutenção. Em consultas grandes com vários parâmetros, usar nomes torna óbvio qual dado está associado a cada campo. Com os pontos de interrogação, a vinculação depende estritamente da ordem numérica, o que facilita erros acidentais ao alterar a consulta.

5. Diferença entre Bindings
O bindValue atribui o valor da variável no exato momento em que o método é executado. Se a variável mudar de valor depois dessa linha, a consulta ainda usará o valor antigo. Já o bindParam vincula uma referência da variável. O valor que será enviado ao banco de dados será aquele que a variável contiver no momento final em que a consulta for executada com a instrução execute.

6. Tipagem no PDO
Sem definir o tipo de dado como inteiro, o PDO pode tratar a variável como texto e colocar aspas ao redor do número na consulta final. No PostgreSQL, colocar aspas ao redor do valor na instrução LIMIT gera um erro de sintaxe SQL e impede a execução da busca.

7. Padrão DAO
O padrão Data Access Object isola todo o código de conexão e manipulação do banco de dados em uma camada própria. Isso atende ao princípio de responsabilidade única do SOLID porque a classe de negócio cuida apenas das regras da aplicação, enquanto o DAO cuida apenas do banco. Se a estrutura do banco mudar, altera-se apenas o DAO, sem impactar o restante do sistema.

8. Operações de Update
A cláusula WHERE define exatamente quais linhas devem ser alteradas. Executar um UPDATE sem WHERE faz com que o banco de dados aplique a alteração em todas as linhas da tabela sem exceção. Em produção, isso sobrescreve e destrói dados válidos de todos os usuários cadastrados no sistema de forma irreversível.

9. Impacto da LGPD
Caso ocorra vazamento de dados de clientes por falhas de segurança como SQL Injection, a empresa pode sofrer sanções administrativas da ANPD. As penalidades incluem advertências, multas que podem chegar a 2 por cento do faturamento limite de 50 milhões de reais por infração, bloqueio ou eliminação dos dados afetados, além de danos à reputação da empresa e processos judiciais promovidos pelos clientes afetados.
