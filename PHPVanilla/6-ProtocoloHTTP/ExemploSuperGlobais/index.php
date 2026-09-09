<!-- Aplicação de página única  de variáveis superglobais ($_GET, $_POST, $_SERVER-->
<?php 

// Dados simulados 

$produtos = [
    ['nome' => 'Teclado USB', 'categoria' => 'Eletrônicos', 'preco' => 80.00],
    ['nome' => 'Mouse sem fio', 'categoria' => 'Eletrônicos', 'preco' => 65.00],
    ['nome' => 'Caderno', 'categoria' => 'Papelaria', 'preco' => 25.00],
    ['nome' => 'Caneta azul', 'categoria' => 'Papelaria', 'preco' => 3.50],
    ['nome' => 'Monitor 24 polegadas', 'categoria' => 'Eletrônicos', 'preco' => 899.90],
    ['nome' => 'Headset Gamer', 'categoria' => 'Eletrônicos', 'preco' => 210.00],
    ['nome' => 'Webcam HD', 'categoria' => 'Eletrônicos', 'preco' => 150.00],
    ['nome' => 'Mochila Escolar', 'categoria' => 'Acessórios', 'preco' => 120.00],
    ['nome' => 'Marca-texto Amarelo', 'categoria' => 'Papelaria', 'preco' => 5.00],
    ['nome' => 'Luminária de Mesa', 'categoria' => 'Móveis & Decoração', 'preco' => 75.00],
    ['nome' => 'Cadeira Ergonômica', 'categoria' => 'Móveis & Decoração', 'preco' => 650.00],
    ['nome' => 'SSD 480GB', 'categoria' => 'Eletrônicos', 'preco' => 220.00],
    ['nome' => 'Bloco de Adesivos Post-it', 'categoria' => 'Papelaria', 'preco' => 12.50],
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

// Processamento do POST

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Recuperar os dados de um formulário
    $nome = trim((string) ($_POST['nome'] ?? ""));
    $email = trim((string) ($_POST['email'] ?? ""));

    // Validação do Servidor

    if(strlen($nome) < 3) {
        $erro['nome'] = "Informe um nome com pelo menos 3 caracteres";
    }

    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro['email'] = "Informe um email válido";
    }

    // Se não existir erros, o cadastro será realizado
    if($erro === []) {
        $mensagemSucesso = "Cadastro realizado com sucesso!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de GET e POST no PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
    <h1>Exemplo prático de GET e POST</h1>

    <section>
        <p>Os filtros serão enviados pela URL (GET)</p>

    <form action="index.php" method="GET">
        <label for="produto">Nome do produto</label>
        <input type="text" name="produto" id="produto" placeholder="Escreva o nome de um produto">

        <label for="preco_maximo">Preço máximo</label>
        <input type="number" name="preco_maximo" id="preco_maximo" step="0.01" placeholder="100">

        <button type="submit">Pesquisar</button>
    </form>

    <h2>Lista de Produtos Filtrados</h2>
    <p>Observe que os dados da pesquisa aparecem na URL</p>

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
    
    </section>

    <section>
        <h2>Cadastro de alunos com POST</h2>
        <p>Os dados serão adicionados no corpo da requisição e não aparecerão na URL</p>

        <?php if ($mensagemSucesso !== "") :?>
            <div class="sucesso">
                <?= $nome ?><br>
                <?= $email ?>
            </div>
            <?php endif; ?>

            <form action="index.php" method="POST" novalidate>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Digite seu Nome">
                <?php if (isset($erro['nome'])): ?>
                    <div class="erro"></div>
                    <?= $erro['nome'] ?>
                    </div>
                <?php endif; ?>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Digite seu Email">
                <?php if (isset($erro['email'])): ?>
                    <div class="erro"></div>
                    <?= $erro['email'] ?>
                    </div>
                <?php endif; ?>
                
                <button type="submit">Cadastre</button>

            </form>
        </section>
    </main>
</body>
</html>