<?php
declare(strict_types=1);
$idade = 44;

if ($idade < 16){
    echo "Voto Proibido";
}
elseif ($idade >= 16 && $idade <= 17 || $idade >= 70) {
    echo "Voto facultativo";
}
else {
    echo "Voto obrigatório";
}
?> 