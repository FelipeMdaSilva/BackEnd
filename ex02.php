<?php
declare(strict_types=1);

$usuario = [
    "nome" => "Carlos Eduardo",
    "idade" => 28,
    "cidade" => "Americana",
    "estado" => "SP",
    "premium" => true
];

$estrela = $usuario["premium"] ? "⭐" : "";

$localizacao = $usuario["cidade"] . "-" . $usuario["estado"];
?>

<div style="border: 1px solid #ccc; padding: 16px; border-radius: 8px; width: 250px; font-family: Arial, sans-serif;">
    <h2 style="margin-top: 0;">
        <?php echo $usuario["nome"] . " " . $estrela; ?>
    </h2>
    <p><strong>Idade:</strong> <?php echo $usuario["idade"]; ?> anos</p>
    <p><strong>Localização:</strong> <?php echo $localizacao; ?></p>
</div>