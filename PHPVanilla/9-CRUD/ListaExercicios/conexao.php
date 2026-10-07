<?php
declare(strict_types=1);

// Retorna uma instância configurada do PDO conectada ao PostgreSQL
function getConexao(): PDO
{
    $host = 'localhost';
    $port = '5432';
    $db   = 'meubanco';
    $user = 'postgres';
    $pass = 'senha';

    $dsn = "pgsql:host={$host};port={$port};dbname={$db}";
    return new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}