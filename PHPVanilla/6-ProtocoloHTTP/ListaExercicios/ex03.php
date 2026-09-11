<?php
declare(strict_types=1);

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$erro = '';
$sucesso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailValido = filter_var($email, FILTER_VALIDATE_EMAIL);
    $senhaValida = strlen($senha) >= 6;

    if (!$emailValido) {
        $erro = "Digite um email válido";
    } elseif (!$senhaValida) {
        $erro = "Digite uma senha válida";
    } else {
        if ($email === "admin@senai.br" && $senha === "senhaSegura123") {
        $sucesso = true;
        } else {
            $erro = "Credenciais inválidas";
        }  
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel de Autenticação Segura</title>
</head>
<body>
    <h2>Login</h2>

    <!-- Exibição de Erro -->
    <?php if ($erro): ?>
        <p style="color: red; font-weight: bold;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <!-- Card de Boas-Vindas (Login Correto) -->
    <?php if ($sucesso): ?>
        <div style="padding: 15px; background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; border-radius: 5px;">
            <h3>Bem-vindo ao sistema!</h3>
            <p>Login realizado com sucesso para <strong><?= htmlspecialchars($email) ?></strong>.</p>
        </div>
    <?php else: ?>
        <!-- Formulário de Login -->
        <form method="POST" action="">
            <label>E-mail:</label><br>
            <!-- Mantém apenas o e-mail preenchido (Sticky) -->
            <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br><br>

            <label>Senha:</label><br>
            <!-- A senha NUNCA é repopulada por motivos de segurança -->
            <input type="password" name="senha" required><br><br>

            <button type="submit">Entrar</button>
        </form>
    <?php endif; ?>
</body>
</html>