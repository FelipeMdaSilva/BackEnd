<?php
declare(strict_types=1);

require_once __DIR__ . '/conexao.php';

// Função vulnerável a SQL Injection devido à concatenação direta de strings
function buscarVulneravel(PDO $pdo, string $termo): void
{
    echo "\n--- Busca Vulnerável ---\n";
    $sql = "SELECT * FROM pecas_industriais WHERE nome = '" . $termo . "'";
    
    try {
        $stmt = $pdo->query($sql);
        $resultados = $stmt->fetchAll();
        echo "Registros encontrados: " . count($resultados) . "\n";
    } catch (PDOException $e) {
        echo "Erro na execução SQL: " . $e->getMessage() . "\n";
    }
}

function buscarProtegido(PDO $pdo, string $termo): void
{
    echo "\n--- Busca Protegida ---\n";
    $sql = "SELECT * FROM pecas_industriais WHERE nome = :termo";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':termo' => $termo]);
    $resultados = $stmt->fetchAll();
    
    echo "Registros encontrados: " . count($resultados) . "\n";
}


$pdo = getConexao();
$payload = "' OR '1'='1";

echo "Injetando payload: {$payload}\n";
buscarVulneravel($pdo, $payload);
buscarProtegido($pdo, $payload);