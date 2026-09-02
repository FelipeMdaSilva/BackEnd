<?php
declare(strict_types=1);

$extrato = [
    ["data" => "2026-09-01", "descricao" => "Salário", "tipo" => "Entrada", "valor" => 4000.00],
    ["data" => "2026-09-02", "descricao" => "Supermercado", "tipo" => "Saida", "valor" => 450.50],
    ["data" => "2026-09-05", "descricao" => "Pix João", "tipo" => "Entrada", "valor" => 200.00],
    ["data" => "2026-09-10", "descricao" => "Conta de Luz", "tipo" => "Saida", "valor" => 120.00],
    ["data" => "2026-09-12", "descricao" => "Cinema", "tipo" => "Saida", "valor" => 65.00]
];

// 1. Cálculo de Totais
$totalEntradas = 0.0;
$totalSaidas = 0.0;

foreach ($extrato as $transacao) {
    if ($transacao["tipo"] === "Entrada") {
        $totalEntradas += $transacao["valor"];
    } else {
        $totalSaidas += $transacao["valor"];
    }
}

$saldoAtual = $totalEntradas - $totalSaidas;

// 3. Filtro de Gastos Altos (Saída > R$ 100,00)
$gastosAltos = array_filter($extrato, function($item) {
    return $item["tipo"] === "Saida" && $item["valor"] > 100.00;
});
?>

<!-- 2. Renderização (Cards e Tabela) -->
<div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto;">
    <h2>Dashboard Financeiro</h2>

    <!-- Cards de Resumo -->
    <div style="display: flex; gap: 10px; margin-bottom: 20px;">
        <div style="flex: 1; background: #f0fdf4; padding: 15px; border-radius: 8px; border: 1px solid #bbf7d0;">
            <small style="color: #166534; font-weight: bold;">Entradas</small>
            <h3 style="color: green; margin: 5px 0 0 0;">
                R$ <?php echo number_format($totalEntradas, 2, ',', '.'); ?>
            </h3>
        </div>

        <div style="flex: 1; background: #fef2f2; padding: 15px; border-radius: 8px; border: 1px solid #fecaca;">
            <small style="color: #991b1b; font-weight: bold;">Saídas</small>
            <h3 style="color: red; margin: 5px 0 0 0;">
                R$ <?php echo number_format($totalSaidas, 2, ',', '.'); ?>
            </h3>
        </div>

        <div style="flex: 1; background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0;">
            <small style="color: #475569; font-weight: bold;">Saldo Atual</small>
            <!-- Regra visual: vermelho se negativo, verde se positivo -->
            <h3 style="color: <?php echo $saldoAtual < 0 ? 'red' : 'green'; ?>; margin: 5px 0 0 0;">
                R$ <?php echo number_format($saldoAtual, 2, ',', '.'); ?>
            </h3>
        </div>
    </div>

    <!-- Tabela Principal de Transações -->
    <h3>Todas as Transações</h3>
    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-bottom: 25px;">
        <thead>
            <tr style="background-color: #f1f5f9;">
                <th>Data</th>
                <th>Descrição</th>
                <th>Tipo</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($extrato as $item): ?>
                <tr>
                    <td><?php echo date("d/m/Y", strtotime($item["data"])); ?></td>
                    <td><?php echo $item["descricao"]; ?></td>
                    <td style="color: <?php echo $item["tipo"] === "Entrada" ? "green" : "red"; ?>; font-weight: bold;">
                        <?php echo $item["tipo"]; ?>
                    </td>
                    <td>R$ <?php echo number_format($item["valor"], 2, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- 3. Mini-tabela no final da página (Atenção: Gastos Altos do Mês) -->
    <div style="background-color: #fffbebfb; border: 1px solid #fcd34d; padding: 15px; border-radius: 8px;">
        <h3 style="color: #b45309; margin-top: 0;">⚠️ Atenção: Gastos Altos do Mês</h3>
        <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse; background: white;">
            <thead>
                <tr style="background-color: #fef3c7;">
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gastosAltos as $item): ?>
                    <tr>
                        <td><?php echo date("d/m/Y", strtotime($item["data"])); ?></td>
                        <td><?php echo $item["descricao"]; ?></td>
                        <td style="color: red; font-weight: bold;">
                            R$ <?php echo number_format($item["valor"], 2, ',', '.'); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>