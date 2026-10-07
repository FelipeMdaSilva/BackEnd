<?php
declare(strict_types=1);

require_once __DIR__ . '/conexao.php';

class PecaDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function excluir(int $id): bool
    {
        $sql = "UPDATE pecas_industriais SET ativo = FALSE WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Retorna apenas os registros ativos no sistema
    public function listarTodos(): array
    {
        $sql = "SELECT * FROM pecas_industriais WHERE ativo = TRUE";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Retorna todos os registros, incluindo inativos, para auditoria contábil
    public function listarParaAuditoria(): array
    {
        $sql = "SELECT * FROM pecas_industriais";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}