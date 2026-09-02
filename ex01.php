<?php
declare(strict_types=1);

$notas = [7.5, 8.0, 6.5, 9.0, 5.5];
$soma = 0;
foreach($notas as $nota) {
    $soma += $nota;
}

$quantidadeNotas = count($notas);
$media = $soma / $quantidadeNotas;

echo "A média final do aluno é $media <br>";

if ($media >= 7) {
    $status = "Aprovado";
    $cor = "green";
}
else {
    $status = "Reprovado";
    $cor = "red";
}

echo "Status: <span style='color: $cor; font-weight: bold;'>$status</span>";
?>