<?php
declare(strict_types=1);

$carrinho = [
    ["produto" => "Notebook", "preco" => 4000.00],
    ["produto" => "Mouse", "preco" => 150.00],
    ["produto" => "Teclado", "preco" => 300.00]
];

$carrinhoBlackFriday = array_map(function($item) {
    $item['preco'] *= 0.8;
    return $item;
}, $carrinho);
?>

<h3>Preços com desconto BLACK FRIDAY:</h3>
<ul>
    <?php foreach ($carrinhoBlackFriday as $item): ?>
        <li>
        <strong><?php echo $item['produto']; ?></strong>
        R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?>
        </li>
<?php endforeach; ?>