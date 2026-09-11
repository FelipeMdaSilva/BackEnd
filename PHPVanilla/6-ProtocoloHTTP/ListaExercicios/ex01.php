<?php 
declare(strict_types=1);
// Dados simulados 

$produtos = [
    ['nome' => 'Teclado USB', 'categoria' => 'Eletrônicos', 'preco' => 80.00],
    ['nome' => 'Luminária de Mesa', 'categoria' => 'Móveis & Decoração', 'preco' => 75.00],
    ['nome' => 'Cadeira Ergonômica', 'categoria' => 'Móveis & Decoração', 'preco' => 650.00],
    ['nome' => 'SSD 480GB', 'categoria' => 'Eletrônicos', 'preco' => 220.00],
    ['nome' => 'Hub USB 4 Portas', 'categoria' => 'Eletrônicos', 'preco' => 45.00],
    ['nome' => 'Garrafa Térmica 500ml', 'categoria' => 'Acessórios', 'preco' => 55.00],
];

// Declarar algumas variáveis
$mensagemSucesso = "";
$erro = [];

$nome = "";
$email = "";

// Processamento usando o GET (busca na lista de produtos) = index.php?produtos=mouse&precom_maximo=100

$buscaProduto = trim((string) ($_GET["produto"] ?? "")); // Verificação/operador de nulidade de uma variável (coalescência nula)
$precoMaximoTexto = trim((string) ($_GET["preco_maximo"] ?? ""));

$produtosFiltrados = $produtos; // Filtro para a lista de produtos

if ($buscaProduto !== "" || $precoMaximoTexto !== "") {
    $produtosFiltrados = array_filter($produtos,
                            function (array $produto) use 
                            ($buscaProduto, $precoMaximoTexto):bool {
                                    $nomeCorrespondente = true;
                                    $precoCorrespondente = true;
                                    if ($buscaProduto !== "") {
                                        $nomeCorrespondente = str_contains(
                                            strtolower(($produto) ["nome"]),
                                            strtolower($buscaProduto)
                                        );
                                    }

                                    if ($precoMaximoTexto !== "") {
                                        $precoMaximo = filter_var(
                                            $precoMaximoTexto, FILTER_VALIDATE_FLOAT
                                        );
                                        $precoCorrespondente = $precoMaximo !== false && $produto["preco"] <= $precoMaximo;
                                    }
                                    return $nomeCorrespondente && $precoCorrespondente;
                            });
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex 01</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
    <h1>Exercício 1</h1>

    <section>
    <form action="ex01.php" method="GET">
        <label for="produto">Nome do produto</label>
        <input type="text" name="produto" id="produto" placeholder="Escreva o nome de um produto">

        <label for="preco_maximo">Preço máximo</label>
        <input type="number" name="preco_maximo" id="preco_maximo" step="0.01" placeholder="100">

        <button type="submit">Pesquisar</button>
    </form>

    <h2>Lista de Produtos Filtrados</h2>

    <?php if ($produtosFiltrados === []): ?>
            <p class="vazio">Nenhum produto encontrado.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($produtosFiltrados as $produto): ?>
                    <tr>
                        <td><?=$produto['nome'] ?></td>
                        <td><?=$produto['categoria'] ?></td>
                        <td>
                            R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>    
    </main>
</body>
</html>