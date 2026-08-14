<?php
declare(strict_types=1);
$valorCompra = 125.99;
$statusFrete = ($valorCompra >= 250.00) ? "Frete grátis" : "Frete R$25,00";
echo $statusFrete;
?>