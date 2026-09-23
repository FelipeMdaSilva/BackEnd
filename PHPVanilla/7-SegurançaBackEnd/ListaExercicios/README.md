### Exercícios Teóricos

1. Conceituação OWASP: XSS significa Cross-Site Scripting. É client-side porque o código malicioso (geralmente JavaScript) é executado no navegador da vítima, mas deve ser prevenido no back-end porque é lá que os dados são validados e higienizados antes de serem exibidos.

2. Reflected vs. Stored:
Refletido: O script não é salvo; ele vem em um link malicioso e é executado imediatamente na resposta.
Gravado (Stored): O script é salvo no banco de dados (ex: em um comentário) e afeta todos os usuários que visualizam aquela página.
Maior estrago: O Stored, pois impacta múltiplos usuários de forma passiva e contínua.

3. Mecanismo de Escapamento: A função htmlspecialchars() converte < em &lt; e > em &gt;. O navegador lê esses valores apenas como texto comum para exibição (caracteres literais), e não como tags HTML executáveis.

4. Flags de Proteção (ENT_QUOTES): A flag serve para converter tanto aspas duplas (") quanto aspas simples (') em entidades HTML. Se for omitida em <input value="...">, um atacante pode fechar as aspas com ' e injetar atributos maliciosos (como onload ou onfocus).

5. Anti-Alucinação PHP: O filtro FILTER_SANITIZE_STRING foi descontinuado (deprecated) a partir do PHP 8.1 devido a comportamentos inconsistentes e inseguros. Em projetos PHP 8.3+, deve-se usar htmlspecialchars() no momento da saída.

6. Validação de E-mail:
empty($email): Apenas verifica se a variável está vazia ou não definida.
filter_var(..., FILTER_VALIDATE_EMAIL): Analisa a estrutura do texto para garantir que ele atende aos padrões e formato válido de um endereço de e-mail.

7. Roubo de Sessão: O atacante injeta um script JavaScript malicioso que lê a propriedade document.cookie e a envia para um servidor controlado por ele. (Dica: a flag HttpOnly no cookie previne isso).

8. Segurança em Camadas: A higienização na entrada (como strip_tags) remove tags, mas não protege contra contextos específicos de exibição. A codificação na saída com htmlspecialchars() garante que qualquer dado, independentemente de como entrou, seja renderizado de forma inofensiva no navegador.