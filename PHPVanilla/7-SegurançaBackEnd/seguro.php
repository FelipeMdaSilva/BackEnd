<?php
declare(strict_types=1);
// Ajustando o código para remover a insegurança

// Função para codificação segura contra XSS
function e(string $texto): string {
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8");
}

// Usar o trim
$nome = trim($_GET["nome"] ?? "");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página segura a XSS</title>
</head>
<body>
    <h1>Perfil do usuário</h1>

    <!-- Blindagem de entrada de dados com função e() -->

    <p>Bem-vindo, <?php echo e($nome)?></p>

    <form action="seguro.php" method="GET">
        <label for="">Digite seu nome:</label>
        <input type="text" name="nome" value="<?php echo e($nome) ?>">
        <button type="submmit">Atualizar</button>
    </form>
    
</body>
</html>