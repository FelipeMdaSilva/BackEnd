<?php
declare(strict_types=1);

/**
 * Função de escapamento universal contra XSS usando ENT_QUOTES
 */
function e(string $texto): string 
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// 1. Capturar o termo pesquisado via método GET
$busca = $_GET['q'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Busca de Produtos</title>
</head>
<body>
    <h1>Busca de Produtos</h1>

    <!-- Formulário de busca (Método GET) -->
    <form method="GET" action="">
        <label for="q">Pesquisar produto:</label><br>
        
        <!-- Manter o termo dentro do input (Sticky Form) -->
        <input type="text" id="q" name="q" value="<?= e($busca) ?>" placeholder="Digite sua busca...">
        
        <button type="submit">Buscar</button>
    </form>

    <hr>

    <?php if ($busca !== ''): ?>
        <!-- Exibir o termo na tela -->
        <p>Você buscou por: <strong><?= e($busca) ?></strong></p>
    <?php endif; ?>
</body>
</html>