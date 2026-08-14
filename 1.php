<?php
$numeroSecreto = rand(1,10);

do {
    $tentativa = rand(1,10); // Simular um palpite aleatório
    
    if($tentativa == $numeroSecreto) {
        echo "Parabéns, acertou!!!";
    }

} while ($tentativa != $numeroSecreto);
?>