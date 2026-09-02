### Parte A

1: Uma função é um código que é criado para realizar tarefas especifícas quando for chamada pelo programa. As vantagens são: Reutilização quando necessário e melhor orgaznição e praticidade

2: Porque quanto mais vezes se repete algo, maior é a chance de ocorrer algum erro nessas repetições. A função ajuda deixando a lógica especificamente em apenas um código, assim diminuindo as chances de erros.

3: Os parâmetros são as informações inseridas dentro da função para que ela seja feita. O retorno é o que será devolvido após a função processar as informações.

```php
function calcularTotal(float $preco, int $quantidade): float {
    return $preco * $quantidade;
}
```
Nesse caso os parâmetros seriam o $preco e a $quantidade. Já o retorno seria o valor da multiplicação entre os parâmetros preco e quantidade.

4: 
```php
function cadastrar(string $nome, int $idade): bool.
```
Nessa declaração os tipos dos valores seriam: cadastrar(nome da função), string(parâmetro do tipo texto) e int(parâmetro do tipo inteiro) e bool(tipo do retorno da função).

5: Uma função que retorna uma string, quer dizer que ela vai retornar especificamente um texto. Já uma função que retorna void, indica que ela não vai retornar nada(vazio).

Exemplo string:
```php
function formatarNome(string $nome): string {
    return strtoupper($nome);
}
$nomeMaiusculo = formatarNome("mariana");
```

Exemplo void:
```php
function exibirMensagem(string $mensagem): void {
    echo $mensagem;
}
exibirMensagem("Operação realizada com sucesso!");
```

6: O PHP possui escopo local restrito dentro de funções. Variáveis declaradas no escopo global (como $cliente = "Mariana";) não são visíveis automaticamente no escopo local da função exibirCliente().

Forma 1 (Passagem por parâmetro):
```php
function exibirCliente(string $cliente): string {
    return $cliente;
}
echo exibirCliente($cliente);
```

Forma 2 (Uso da palavra-chave global):
```php
function exibirCliente(): string {
    global $cliente;
    return $cliente;
}
```

7: O que muda (float &$valor): O símbolo & indica que o parâmetro é passado por referência, e não por valor.

Diferença entre cópia e variável original:

Alterar uma cópia (passagem por valor): A função cria uma cópia da variável enviada. Qualquer alteração feita dentro da função afeta apenas a cópia local, mantendo a variável original intacta.

Alterar a variável original (passagem por referência): A função recebe um ponteiro para o mesmo endereço de memória da variável original. Qualquer alteração feita no parâmetro dentro da função modifica diretamente a variável que foi passada na chamada.

8: 
strlen()
Categoria: Strings
Finalidade: Retorna o tamanho (quantidade de caracteres) de uma string.
Parâmetros principais: $string (a string cujo tamanho será medido).
Valor retornado: Um número inteiro (int) representando a quantidade de caracteres.

strtoupper()
Categoria: Strings
Finalidade: Converte todos os caracteres de uma string para letras maiúsculas.
Parâmetros principais: $string (o texto a ser convertido).
Valor retornado: A string original convertida para maiúsculas (string).

strtolower()
Categoria: Strings
Finalidade: Converte todos os caracteres de uma string para letras minúsculas.
Parâmetros principais: $string (o texto a ser convertido).
Valor retornado: A string original convertida para minúsculas (string).

ucfirst()
Categoria: Strings
Finalidade: Converte o primeiro caractere de uma string para letra maiúscula.
Parâmetros principais: $string (o texto a ser modificado).
Valor retornado: A string com a primeira letra maiúscula (string).

str_replace()
Categoria: Strings
Finalidade: Substitui todas as ocorrências de um texto/termo de busca por outro texto em uma string.
Parâmetros principais: $search (o valor a ser localizado), $replace (o valor de substituição) e $subject (a string onde será feita a busca e substituição).
Valor retornado: A string com os valores substituídos (string).

9: 
Resultado exibido: 90100.
Explicação do motivo:O código define a função aplicarDesconto() que recebe um valor (100.00) e devolve 90 (100 * 0.90).
A primeira instrução echo aplicarDesconto($valor); imprime o resultado retornado pela função: 90.
Como o parâmetro $preco foi passado por valor (cópia) e não por referência, a variável original $valor não foi alterada dentro da função.
A segunda instrução echo $valor; imprime o valor original mantido na variável: 100.

10:
Sintaxe:
```php
strlen(string $string): int
```
Parâmetro recebido: Recebe uma única variável do tipo string (o texto cujo tamanho/comprimento você deseja medir).
Tipo de retorno: Retorna um valor do tipo int (inteiro), representando a quantidade de caracteres presentes na string enviada.