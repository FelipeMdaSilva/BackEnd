<?php
declare(strict_types=1);
$cargoUsuario = "Gerente";
$senhaDigitada = "SenhaSegura123";
$senhaSistema = "SenhaSegura123";

if ($senhaDigitada == $senhaSistema && ($cargoUsuario == "Diretor" || "Gerente")) {
    echo "Acesso Liberado";
}
else {
    echo "Acesso negado";
}
?>