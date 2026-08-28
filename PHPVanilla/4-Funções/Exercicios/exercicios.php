<?php
declare(strict_types=1);

// Exercicio 1
function calcularIMC(float $peso, float $altura): float {
    return $peso / ($altura * $altura);
}

$peso1 = 80.0;
$altura1 = 1.85;
$imc1 = calcularIMC($peso1, $altura1);
echo "O peso é $peso1, a altura é $altura1 e o IMC é " . number_format($imc1, 2) . "\n";

$peso2 = 60.0;
$altura2 = 1.60;
$imc2 = calcularIMC($peso2, $altura2);
echo "O peso é $peso2, a altura é $altura2 e o IMC é " . number_format($imc2, 2) . "\n";

$peso3 = 105.0;
$altura3 = 2.05;
$imc3 = calcularIMC($peso3, $altura3);
echo "O peso é $peso3, a altura é $altura3 e o IMC é " . number_format($imc3, 2);

// Exercicio 2

function classificarIMC(float $imc): string {
    if ($imc < 18.5) {
        return "Abaixo do peso";
    } elseif ($imc <= 24.9) {
        return "Peso normal";
    } elseif ($imc <= 29.9) {
        return "Sobrepeso";
    } else {
        return "Obesidade";
    }
}

$valor = 22.546;
echo "O IMC é " . classificarIMC($valor);

// Exercicio 3
?>