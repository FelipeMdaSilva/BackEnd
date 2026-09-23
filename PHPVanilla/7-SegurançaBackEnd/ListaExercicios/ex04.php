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
 * Sanitiza campos de texto aplicando trim e strip_tags
 */
function sanitizarTexto(string $dado): string 
{
    return trim(strip_tags($dado));
}

/**
 * Valida os dados do colaborador garantindo os tipos e formatos corretos
 */
function validarColaborador(array $dados): array 
{
    $erros = [];
    $dadosValidados = [];

    // 1. Sanitização e Validação do Nome
    $nome = sanitizarTexto($dados['nome'] ?? '');
    if (mb_strlen($nome) < 3) {
        $erros[] = 'O nome do colaborador deve ter no mínimo 3 caracteres.';
    } else {
        $dadosValidados['nome'] = $nome;
    }

    // 2. Validação do E-mail
    $email = trim($dados['email'] ?? '');
    $emailValido = filter_var($email, FILTER_VALIDATE_EMAIL);
    if ($emailValido === false) {
        $erros[] = 'Informe um endereço de e-mail válido.';
    } else {
        $dadosValidados['email'] = $emailValido;
    }

    // 3. Validação da Matrícula (Inteiro)
    $matricula = filter_var($dados['matricula'] ?? null, FILTER_VALIDATE_INT);
    if ($matricula === false || $matricula <= 0) {
        $erros[] = 'A matrícula deve ser um número inteiro positivo.';
    } else {
        $dadosValidados['matricula'] = $matricula;
    }

    // 4. Validação do Salário (Float)
    $salarioRaw = str_replace(',', '.', $dados['salario'] ?? '');
    $salario = filter_var($salarioRaw, FILTER_VALIDATE_FLOAT);
    if ($salario === false || $salario <= 0) {
        $erros[] = 'O salário deve ser um valor numérico válido maior que zero.';
    } else {
        $dadosValidados['salario'] = $salario;
    }

    return [
        'sucesso' => empty($erros),
        'erros'   => $erros,
        'dados'   => $dadosValidados
    ];
}

// Processamento do formulário
$feedback = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = validarColaborador($_POST);
    $feedback = $resultado;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Colaboradores</title>
</head>
<body>
    <h1>Cadastro de Colaboradores</h1>

    <!-- Exibição de Feedback Estruturado -->
    <?php if ($feedback !== null): ?>
        <?php if (!$feedback['sucesso']): ?>
            <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
                <strong>Erros encontrados no formulário:</strong>
                <ul>
                    <?php foreach ($feedback['erros'] as $erro): ?>
                        <li><?= e($erro) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else: ?>
            <div style="color: green; border: 1px solid green; padding: 10px; margin-bottom: 15px;">
                <strong>Colaborador cadastrado com sucesso!</strong>
                <ul>
                    <li><strong>Nome:</strong> <?= e($feedback['dados']['nome']) ?></li>
                    <li><strong>E-mail:</strong> <?= e($feedback['dados']['email']) ?></li>
                    <li><strong>Matrícula:</strong> <?= e((string)$feedback['dados']['matricula']) ?></li>
                    <li><strong>Salário:</strong> R$ <?= number_format($feedback['dados']['salario'], 2, ',', '.') ?></li>
                </ul>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <form method="POST" action="">
        <div>
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" value="<?= e($_POST['nome'] ?? '') ?>" required>
        </div>
        <br>
        <div>
            <label for="email">E-mail:</label><br>
            <input type="email" id="email" name="email" value="<?= e($_POST['email'] ?? '') ?>" required>
        </div>
        <br>
        <div>
            <label for="matricula">Matrícula (Inteiro):</label><br>
            <input type="number" id="matricula" name="matricula" value="<?= e($_POST['matricula'] ?? '') ?>" required>
        </div>
        <br>
        <div>
            <label for="salario">Salário (Float):</label><br>
            <input type="text" id="salario" name="salario" value="<?= e($_POST['salario'] ?? '') ?>" placeholder="ex: 3500.50" required>
        </div>
        <br>
        <button type="submit">Cadastrar Colaborador</button>
    </form>
</body>
</html>