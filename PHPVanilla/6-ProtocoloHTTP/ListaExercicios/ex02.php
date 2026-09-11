<?php
declare(strict_types=1);

function calcularImc(float $peso, float $altura): float {
    return $peso / ($altura * $altura);
}

function classificarImc(float $imc): string {
    if ($imc <= 18.5) return "Abaixo do Peso";
    if ($imc <= 24.9) return "Normal";
    if ($imc <= 29.9) return "Sobrepeso";
    return "Obesidade";
}

$nome = $_POST['nome'] ?? '';
$peso = $_POST['peso'] ?? '';
$altura = $_POST['altura'] ?? '';
$erro = '';
$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pesoFloat = filter_var($peso, FILTER_VALIDATE_FLOAT);
    $alturaFloat = filter_var($altura, FILTER_VALIDATE_FLOAT);

    if ($pesoFloat === false || $pesoFloat < 20 || $pesoFloat > 300) {
        $erro = "O peso deve ser um número entre 20kg e 300kg.";
    } elseif ($alturaFloat === false || $alturaFloat < 0.5 || $alturaFloat > 2.5) {
        $erro = "A altura deve ser um número entre 0.5m e 2.5m.";
    } else {
        $imc = calcularIMC($pesoFloat, $alturaFloat);
        $classificacao = classificarIMC($imc);
        
        $cor = 'green';
        if ($classificacao === 'Sobrepeso') {
            $cor = 'orange';
        } elseif ($classificacao === 'Obesidade') {
            $cor = 'red';
        }

        $resultado = [
            'imc' => number_format($imc, 2),
            'classificacao' => $classificacao,
            'cor' => $cor
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de IMC</title>
</head>
<body>
    <h2>Calculadora de IMC</h2>

    <?php if ($erro): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <!-- Formulário com Sticky Form (mantém os valores digitados) -->
    <form method="POST" action="">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= htmlspecialchars($nome) ?>" required><br><br>

        <label>Peso (kg):</label><br>
        <input type="number" step="0.01" name="peso" value="<?= htmlspecialchars($peso) ?>" required><br><br>

        <label>Altura (m):</label><br>
        <input type="number" step="0.01" name="altura" value="<?= htmlspecialchars($altura) ?>" required><br><br>

        <button type="submit">Calcular IMC</button>
    </form>

    <!-- Exibição do Resultado com estilo condicional -->
    <?php if ($resultado): ?>
        <hr>
        <h3>Resultado para <?= htmlspecialchars($nome) ?>:</h3>
        <p style="color: <?= $resultado['cor'] ?>; font-weight: bold; font-size: 1.2em;">
            IMC: <?= $resultado['imc'] ?> — <?= $resultado['classificacao'] ?>
        </p>
    <?php endif; ?>
</body>
</html>