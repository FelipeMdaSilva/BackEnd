<?php
declare(strict_types=1);

$filmes = [
    ["titulo" => "Matrix", "genero" => "Ficção", "classificacao_idade" => 16],
    ["titulo" => "Shrek", "genero" => "Animação", "classificacao_idade" => 0],
    ["titulo" => "Deadpool", "genero" => "Ação", "classificacao_idade" => 18],
    ["titulo" => "Procurando Nemo", "genero" => "Animação", "classificacao_idade" => 0],
    ["titulo" => "Vingadores", "genero" => "Ação", "classificacao_idade" => 12]
];

$filmesInfantis = array_filter($filmes, fn($f) => $f["classificacao_idade"] <= 12);
?>  

<h3>Lista de filmes infantis:</h3>
<ul>
    <?php foreach ($filmesInfantis as $filme): ?>
        <li>
        <strong><?php echo $filme['titulo']; ?></strong>
        </li>
<?php endforeach; ?>
</ul>