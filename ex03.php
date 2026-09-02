<?php
declare(strict_types=1);

$funcionarios = [
    ["id" => 1, "nome" => "Ana Souza", "cargo" => "Dev Front-End", "salario" => 4500.00],
    ["id" => 2, "nome" => "Bruno Costa", "cargo" => "Dev Back-End", "salario" => 5200.00],
    ["id" => 3, "nome" => "Carla Dias", "cargo" => "Tech Lead", "salario" => 8900.00],
    ["id" => 4, "nome" => "Daniel Silva", "cargo" => "Estagiário", "salario" => 1500.00],
];

?>
<?php
$funcionarios = [
    ["id" => 1, "nome" => "Ana Souza", "cargo" => "Dev Front-End", "salario" => 4500.00],
    ["id" => 2, "nome" => "Bruno Costa", "cargo" => "Dev Back-End", "salario" => 5200.00],
    ["id" => 3, "nome" => "Carla Dias", "cargo" => "Tech Lead", "salario" => 8900.00],
    ["id" => 4, "nome" => "Daniel Silva", "cargo" => "Estagiário", "salario" => 1500.00],
];

// variável para armazenar a folha de pagamento 
$totalFolha = 0;

// Cria a abertura da tabela e o cabeçalho
echo "<table border='1' cellpadding='8' style='border-collapse: collapse; font-family: sans-serif;'>";
echo "<tr><th>ID</th><th>Nome</th><th>Cargo</th><th>Salário</th></tr>";

//Foreach para preencher as linhas
foreach ($funcionarios as $funcionario) {
    // Soma o salário ao total
    $totalFolha += $funcionario['salario'];

    // Formata o salário para Real (R$)
    $salarioFormatado = "R$ " . number_format($funcionario['salario'], 2, ",", ".");

    // Imprime a linha do funcionário
    echo "<tr>";
    echo "<td>" . $funcionario['id'] . "</td>";
    echo "<td>" . $funcionario['nome'] . "</td>";
    echo "<td>" . $funcionario['cargo'] . "</td>";
    echo "<td>" . $salarioFormatado . "</td>";
    echo "</tr>";
}

// Formata o total geral
$totalFormatado = "R$ " . number_format($totalFolha, 2, ",", ".");

// Linha final com o total gasto
echo "<tr style='font-weight: bold;'>";
echo "<td colspan='3' align='right'>Total Gasto pela Empresa:</td>";
echo "<td>" . $totalFormatado . "</td>";
echo "</tr>";

echo "</table>";
?>