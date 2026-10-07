<?php
declare(strict_types=1);

require_once __DIR__ . '/conexao.php';

// Cadastra uma nova ferramenta no banco de dados usando Prepared Statement
function cadastrarFerramenta(PDO $pdo): void
{
    echo "Nome da ferramenta: ";
    $nome = trim((string) fgets(STDIN));

    $sql = "INSERT INTO ferramentas (nome, ativo) VALUES (:nome, TRUE)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nome' => $nome]);

    echo "Ferramenta cadastrada com sucesso!\n";
}

// Lista todas as ferramentas ativas cadastradas no sistema
function listarFerramentas(PDO $pdo): void
{
    $sql = "SELECT id, nome FROM ferramentas WHERE ativo = TRUE";
    $stmt = $pdo->query($sql);
    $ferramentas = $stmt->fetchAll();

    echo "\n--- Ferramentas Ativas ---\n";
    foreach ($ferramentas as $item) {
        echo "[#{$item['id']}] {$item['nome']}\n";
    }
}

// Loop principal de execução do menu via linha de comando (CLI)
$pdo = getConexao();
do {
    echo "\n1: Cadastrar | 2: Listar | 3: Sair\nOpção: ";
    $opcao = trim((string) fgets(STDIN));

    if ($opcao === '1') {
        cadastrarFerramenta($pdo);
    } elseif ($opcao === '2') {
        listarFerramentas($pdo);
    }
} while ($opcao !== '3');

echo "Programa encerrado";