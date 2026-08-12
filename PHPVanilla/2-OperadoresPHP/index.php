<?php
# 1. Declare => evitar operações entre variáveis de tipos diferentes
declare(strict_types=1);

# Criar um cálculo de Holerite em PHP

# 2. Declarar as constantes
const TAXA_INSS = 0.08; #8% => 8/100
const DESCONTO_VT = 150.00;

# 3. Declarar as variáveis
# Dados do empregado
$nomeFuncionario = "Maria Silva";
$salarioBase = 3200.50;
$horasExtras = 10;

# Declaração de variáveis usando LowerCamelCase
# Regra -> primeira palavra toda minúscula e depois as demais usa-se maiúscula na primeira letra
# Exemplo: $hojeEstaUmDiaBonito

# 4. Cálculos dos sálarios
$valorHoraExtra = ($salarioBase / 220) * 1.6;
# Crie a variável $totalHorasExtras
$totalHorasExtras = $valorHoraExtra * $horasExtras;
# Crie a variável $salarioBruto
$salarioBruto = $salarioBase + $totalHorasExtras;
# Crie a variável $descontoInss
$descontoInss = $salarioBruto * TAXA_INSS;
# Crie a variável $salarioLiquido
$salarioLiquido = ($salarioBruto - $descontoInss) - DESCONTO_VT;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holerite - <?php echo $nomeFuncionario ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Demonstrativo de Pagamento</h2>
    <!-- Saída de dados misturando HTML e PHP -->
    <table>
        <tr>
            <th>Colaborador(a)</th>
            <td><?php echo $nomeFuncionario ?></td>
        </tr>
        <tr>
            <th>Salário Base</th>
            <!-- Usar uma função chamada number format (formata saída de números) -->
            <td>R$ <?php echo number_format($salarioBase, 2, ",", "." ); ?></td>
        </tr>
        <!-- Fazer as demais linhas da tabela utilizando as variáveis criadas -->
         <tr>
            <th>Horas extras trabalhadas</th>
            <td> <?php echo $horasExtras ?></td>
         </tr>
         <tr>
            <th>Valor da hora extra</th>
            <td>R$ <?php echo number_format($valorHoraExtra, 2, ",", "." ); ?></td>
         </tr>
         <tr>
            <th>Total das horas extras</th>
            <td>R$ <?php echo number_format($totalHorasExtras, 2, ",", "." ); ?></td>
         </tr>
         <tr>
            <th>Salário bruto</th>
            <td>R$ <?php echo number_format($salarioBruto, 2, ",", "." ); ?></td>
         </tr>
         <tr>
            <th>Desconto do INSS</th>
            <td>R$ <?php echo number_format($descontoInss, 2, ",", "." ); ?></td>
         </tr>
         <tr>
            <th>Desconto do VT</th>
            <td>R$ <?php echo number_format(DESCONTO_VT, 2, ",", "."); ?></td>
         </tr>
         <tr>
            <th>Salário líquido</th>
            <td>R$ <?php echo number_format($salarioLiquido, 2, ",", "." ); ?></td>
         </tr>
    </table>
</body>
</html>