<?php

// Declaração das variaveis
$categoriaCliente = "B";
$dividaAtual = 1500;

// Utilizando match para categorizar a taxa de acordo com a categoria do cliente
$taxa = match($categoriaCliente) {
    "A" => 0.01,
    "B" => 0.02,
    "C" => 0.03,
    default => 0.05
};

// Imprimindo as informações
echo "Cliente: $categoriaCliente <br>";
echo "Taxa: ";
echo $taxa * 100;
echo "%<br><br>";


// Utilizando for para fazer a conta dos 12 meses
for($mes = 1; $mes <=12; $mes++) {
    
    // Usando if para parar o codigo quando chegar no mes 6, e usando continue pra pular
    if ($mes == 6) {
        echo "Mês - 6; Sem cobrança!!! <br>";
        continue;
    }

    // Fazendo os calculos
    $jurosDoMes = $dividaAtual * $taxa;
    $saldoAtual = $dividaAtual + $jurosDoMes;
    $dividaAtual = $saldoAtual;

    // Imprimindo as informações finais
    echo "Mês - $mes; Juros - $jurosDoMes; Divida - $saldoAtual <br>";
}
?>