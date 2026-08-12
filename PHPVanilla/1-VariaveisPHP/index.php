<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudo de Variáveis</title>
</head>
<body>
    <h1>Estudo de Variáveis</h1>
    <hr>
    <?php 
    // para criar variáveis em php basta usar o sinal de $
    // variaveis em php são NÃO tipadas, NÃO precisa declarar o tipo (texto, numeros, booleanas)
    // ao atribuir valor para a variável a tipagem é automática
    $nome = "João"; // criação da variavel nome com o valor textual "João"
    $idade = 25; // criação da variavel idade com o valor numerico 25
    $ativo = true; // criação da variavel ativo com o valor booleano true
    $salario = 1520.68; // variavel numerica - decimal (float - double)
    $status = null; // variavel nula
    //$endereço // Variável Undefined, não é possivel declarar uma variavel sem atribuir um valor a ela, não existe Undefined em PHP

    // Dicas para criação de variáveis:
    // Não inicie o nome uma variavel com numeros
    // Não utilize espaços em branco
    // Não utilize caracteres especiais, somente o underline
    // Crie variaveis com nomes que ajudarão a identificar melhor a mesma
    // Evite utilizar letras maiúsculas.

    //Exibir as variáveis na tela
    echo "Nome: $nome <br>"; 
    echo "Idade: $idade <br>";
    echo "Ativo: $ativo <br>";
    echo "Salário: $salario <br>";
    echo "Status: $status <br>";


    echo "<br><h3> Constantes </h3><br>";
    // Constantes são representadas pela palavra "const" ou "define" seguida do nome da constantes
    const PI = 3.14; # Constante do tipo number (float)
    const EMPRESA = "Google"; # Constante do tipo string
    define("SITE", "www.google.com"); # Declaração de constante do tipo string usando "define"
    # Uma boa prática é utilizar letras maiúsculas para nomear constantes, para diferenciar das variáveis

    # Exibir as constantes na tela
    echo "Valor de PI: " . PI . "<br>";
    echo "Nome da empresa: " . EMPRESA . "<br>";
    echo "Site: " . SITE . "<br>";

    # Tentar alterar o valor de uma constante, isso irá gerar um erro de código, pois constantes não podem ser alteradas
    # PI = 3.14159; Isso é um erro
    # Redeclarar uma constante também ira gerar um erro
    # const SITE = "www.google.com.br"; Isso é um erro

    # Regra de ouro: Sempre coloque a instrução "declare(strict_types=1);" no início do seu código PHP, isso blindará o seu sistema contra mistura acidentais contra tipo de dados.


    # Utilização de texto (Concatenação Vs Interpolação)

    # Exemplo de concatenação => Juntar duas ou mais strings utilizando o operador "." (ponto)
    echo "Olá, ". $nome . "! Seja bem-vindo ao nosso site! <br>";

    # Exemplo de interpolação => Utilização de variáveis dentro de um texto, utilizando aspas duplas no texto
    echo "$nome, tem $idade anos e seu salário é R$ $salario reais <br>"; #Forma mais corrreta de misturar texto e variáveis

    ?>


</body>
</html>