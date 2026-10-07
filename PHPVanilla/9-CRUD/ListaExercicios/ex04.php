<?php
declare(strict_types=1);

function registrarMovimentacao(PDO $pdo, int $pecaId, int $quantidade, string $tipo): bool {
    $pdo->beginTransaction();

    // Busca o saldo atual
    $stmt = $pdo->prepare("SELECT quantidade FROM pecas_industriais WHERE id = :id");
    $stmt->execute([':id' => $pecaId]);
    $saldoAtual = (int) $stmt->fetchColumn();

    // Calcula o novo saldo
    $novoSaldo = ($tipo === 'ENTRADA') ? ($saldoAtual + $quantidade) : ($saldoAtual - $quantidade);

    // Cancela se o saldo for negativo
    if ($novoSaldo < 0) {
        $pdo->rollBack();
        return false;
    }

    // Atualiza o estoque
    $update = $pdo->prepare("UPDATE pecas_industriais SET quantidade = :qtd WHERE id = :id");
    $update->execute([':qtd' => $novoSaldo, ':id' => $pecaId]);

    $pdo->commit();
    return true;
}