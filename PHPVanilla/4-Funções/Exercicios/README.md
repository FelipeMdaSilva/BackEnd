#### Parte A

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