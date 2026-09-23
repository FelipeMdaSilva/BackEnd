<?php
declare(strict_types=1);

/**
 * Função de escapamento universal contra XSS
 */
function e(string $texto): string 
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Valida se a URL é válida e se usa estritamente os protocolos HTTP ou HTTPS
 */
function validarUrlPortfolio(string $url): ?string 
{
    $urlTratada = trim($url);

    // 1. Valida o formato geral de URL
    if (!filter_var($urlTratada, FILTER_VALIDATE_URL)) {
        return null;
    }

    // 2. Garante o uso estrito de http:// ou https:// (bloqueia javascript:, data:, etc.)
    if (!str_starts_with($urlTratada, 'http://') && !str_starts_with($urlTratada, 'https://')) {
        return null;
    }

    return $urlTratada;
}

// Processamento do Formulário
$nome = trim($_POST['nome'] ?? '');
$urlEnviada = trim($_POST['url'] ?? '');

$erro = null;
$linkValido = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($nome)) {
        $erro = 'Por favor, informe seu nome.';
    } else {
        $linkValido = validarUrlPortfolio($urlEnviada);
        if ($linkValido === null) {
            $erro = 'URL inválida! O link deve ser um endereço válido e iniciar com http:// ou https://';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Validador de Links de Portfólio</title>
</head>
<body>
    <h1>Cadastrar Portfólio</h1>

    <?php if ($erro !== null): ?>
        <p style="color: red;"><?= e($erro) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <div>
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" value="<?= e($nome) ?>" required>
        </div>
        <br>
        <div>
            <label for="url">Link do GitHub / LinkedIn:</label><br>
            <input type="text" id="url" name="url" value="<?= e($urlEnviada) ?>" placeholder="https://..." required>
        </div>
        <br>
        <button type="submit">Cadastrar</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $erro === null && $linkValido !== null): ?>
        <hr>
        <h2>Portfólio Cadastrado:</h2>
        <p>Desenvolvedor: <strong><?= e($nome) ?></strong></p>
        <p>
            <!-- Renderização segura contra injeção de javascript: -->
            <a href="<?= e($linkValido) ?>" target="_blank" rel="noopener noreferrer">Visitar Portfólio</a>
        </p>
    <?php endif; ?>
</body>
</html>