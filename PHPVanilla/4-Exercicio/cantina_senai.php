<?php
declare(strict_types=1);

$produtos = [
1 => ["nome" => "Coxinha", "preco" => 6.00, "estoque" => 10],
2 => ["nome" => "Suco", "preco" => 5.00, "estoque" => 8],
3 => ["nome" => "Sanduíche", "preco" => 12.00, "estoque" => 5],
4 => ["nome" => "Bolo", "preco" => 7.50, "estoque" => 6]
];

$pedido = [];
$opcao = 0;
do {
    echo "1 - Listar produtos <br>";
    echo "2 - Adicionar produto ao pedido <br>";
    echo "3 - Exibir resumo do pedido <br>";
    echo "4 - Finalizar compra <br>";
    echo "0 - Sair sem finalizar <br>";

    $opcao++;


    match($opcao) {
    1 => print "Listando produtos <br>",
    2 => print "Adicionando produtos ao pedido <br>",
    3 => print "Exibindo resumo do pedido <br>",
    4 => print "Finalizando compra <br> <br>",
    0 => print "Saindo sem finalizar <br>",
    default => print "Erro: Digite uma opção válida <br>"
    };

} while ($opcao !=4 && $opcao !=0);

foreach ($produtos as $id => $produto) {
    echo "ID: " . $id . " - " . $produto["nome"] . " | R$: " . $produto["preco"] . " | Estoque: " . " - ". $produto["estoque"] .  "<br>";
}
?>