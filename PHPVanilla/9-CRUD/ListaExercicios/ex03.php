<?php
declare(strict_types=1);

require_once __DIR__ . '/conexao.php';

// Captura a página via GET e calcula o deslocamento (offset)
$pagina = (int) ($_GET['p'] ?? 1);
$pagina = max(1, $pagina);
$limite = 5;
$offset = ($pagina - 1) * $limite;

$pdo = getConexao();

// Prepara e vincula os parâmetros explicitamente como inteiros
$sql = "SELECT * FROM pecas_industriais ORDER BY id LIMIT :limite OFFSET :offset";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$pecas = $stmt->fetchAll();

// Exibição simples dos resultados
echo "<h1>Página {$pagina}</h1>";
echo "<ul>";
foreach ($pecas as $peca) {
    echo "<li>#" . htmlspecialchars((string) $peca['id']) . " - " . htmlspecialchars((string) $peca['nome']) . "</li>";
}
echo "</ul>";