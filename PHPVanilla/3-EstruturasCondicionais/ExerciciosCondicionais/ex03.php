<?php
declare(strict_types=1);
$peso = 95.5;
$altura = 1.80;
$imc = $peso / ($altura * $altura);

if ($imc < 18.5) {
    echo "Abaixo do Peso";
}
elseif ($imc >= 18.5 && $imc <= 24.9) {
    echo "Peso normal";
}
elseif ($imc >= 25.0 && $imc <= 29.9) {
    echo "Sobrepeso";
}
elseif ($imc >= 30.0 && $imc <= 34.9) {
    echo "Obesidade grau 1";
}
else {
    echo "Obesidade grau 2 ou 3";
}
?>