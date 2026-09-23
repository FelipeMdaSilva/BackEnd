<?php
declare(strict_types=1);

/**
 * Função de escapamento universal contra XSS
 */
function e(string $texto): string 
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$arquivoJson = __DIR__ . '/chat.json';
$erro = null;

// Garante que o arquivo chat.json exista
if (!file_exists($arquivoJson)) {
    file_put_contents($arquivoJson, json_encode([], JSON_PRETTY_PRINT));
}

// Processamento do Envio de Mensagem
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    // 1. Valida se a mensagem não ultrapassa 250 caracteres
    if (empty($usuario) || empty($mensagem)) {
        $erro = 'Por favor, preencha o nome do usuário e a mensagem.';
    } elseif (mb_strlen($mensagem) > 250) {
        $erro = 'A mensagem não pode ultrapassar 250 caracteres.';
    } else {
        // Carrega as mensagens atuais do chat.json
        $conteudoAtual = file_get_contents($arquivoJson);
        $chatData = json_decode($conteudoAtual, true) ?? [];

        // Adiciona a nova mensagem (dados puros, sem escapar antes de salvar)
        $chatData[] = [
            'usuario' => $usuario,
            'mensagem' => $mensagem,
            'horario' => date('H:i:s')
        ];

        // Armazena as mensagens no arquivo local chat.json
        file_put_contents($arquivoJson, json_encode($chatData, JSON_PRETTY_PRINT));

        // Redireciona para evitar reenvio de formulário no F5
        header('Location: ex05_chat_operacao.php');
        exit;
    }
}

// Carrega o histórico para exibição
$mensagensSalvas = json_decode(file_get_contents($arquivoJson), true) ?? [];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Chat Industrial - Operação</title>
</head>
<body>
    <h1>Chat da Operação</h1>

    <?php if ($erro !== null): ?>
        <p style="color: red;"><?= e($erro) ?></p>
    <?php endif; ?>

    <!-- Formulário para envio de mensagem -->
    <form method="POST" action="">
        <div>
            <label for="usuario">Usuário (Operador/Supervisor):</label><br>
            <input type="text" id="usuario" name="usuario" value="<?= e($_POST['usuario'] ?? '') ?>" required>
        </div>
        <br>
        <div>
            <label for="mensagem">Mensagem (máx 250 caracteres):</label><br>
            <textarea id="mensagem" name="mensagem" rows="3" maxlength="250" style="width: 100%;" required></textarea>
        </div>
        <br>
        <button type="submit">Enviar Mensagem</button>
    </form>

    <hr>

    <h2>Histórico do Chat</h2>
    <div style="border: 1px solid #ccc; padding: 10px; max-width: 500px; background: #f9f9f9;">
        <?php if (empty($mensagensSalvas)): ?>
            <p>Nenhuma mensagem enviada até o momento.</p>
        <?php else: ?>
            <?php foreach ($mensagensSalvas as $msg): ?>
                <div style="margin-bottom: 10px; border-bottom: 1px dashed #ddd; padding-bottom: 5px;">
                    <small>[<?= e($msg['horario']) ?>]</small> 
                    <strong><?= e($msg['usuario']) ?>:</strong><br>
                    
                    <!-- 
                        DESAFIO DE ORDEM DE EXECUÇÃO:
                        A ordem correta é nl2br(e($mensagem)). 

                        MOTIVO:
                        Se executássemos e(nl2br($mensagem)), a função nl2br() inseriria 
                        as tags HTML "<br />" nas quebras de linha ANTES do escapamento. 
                        Em seguida, a função e() (htmlspecialchars) transformaria as tags <br />
                        em entidades HTML "&lt;br /&gt;". 
                        O navegador exibiria o texto "<br />" literalmente na tela do usuário 
                        em vez de quebrar a linha, quebrando o layout e inutilizando a função do nl2br.
                    -->
                    <?= nl2br(e($msg['mensagem'])) ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>