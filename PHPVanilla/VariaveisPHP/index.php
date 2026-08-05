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
    $salario = 1520.68; // variavel numerica - decimal
    $status = null; // variavel nula

    // Dicas para criação de variáveis
    // Não inicie o nomde uma variavel com numeros
    // Não utilize espaços em branco
    // Não utilize caracteres especiais, somente o underline
    // Crie variaveis com nomes que ajudarão a identificar melhor a mesma
    // Evite utilizar letras maiúsculas

    echo $nome;
    echo "<br>";
    echo "Idade: $idade";

    ?>


</body>
</html>