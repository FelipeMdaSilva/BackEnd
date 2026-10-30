<?php 
declare(strict_types=1);

// Ponto único de entrada da aplicação: Inicializa a sessão e o autoloader PSR-4

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once dirname(__DIR__) . "/vendor/autoload.php";

use App\Core\Roteador;

use App\Controllers\AuthController;
use App\Core\Guard\AuthGuard;
use App\Controllers\HomeController;
use App\Controllers\ProdutoController;
use App\Controllers\MovimentacaoController;

$roteador = new Roteador();

// 1. Rotas públicas -> Qualquer pessoa pode acessar
$roteador->registrar('GET', '/login', [AuthController::class, 'formularioLogin']);
$roteador->registrar('POST', '/login', [AuthController::class, 'login']);

// 2. Rotas protegidas de Consulta (Gestor, Almoxarige e Admin)
$guardConsulta = [[AuthGuard::class, ['gestor', 'almoxarife', 'admin']]];
$roteador->registrar('GET', '/', [HomeController::class, 'index'], $guardConsulta);
$roteador->registrar('GET', '/produtos', [ProdutoController::class, 'listar'], $guardConsulta);
$roteador->registrar('GET', '/movimentacoes', [MovimentacaoController::class, 'historico'], $guardConsulta);
$roteador->registrar('POST', '/logout', [AuthController::class, 'logout'], $guardConsulta);

//3. Rotas Operacionais de Perfil (Almoxarife e Admin)
$guardOperacional = [[AuthGuard::class, ['almoxarife', 'admin']]];
$roteador->registrar('GET', '/produtos/novo', [ProdutoController::class, 'formulario'], $guardOperacional);
$roteador->registrar('POST', '/produtos/salvar', [ProdutoController::class, 'salvar'], $guardOperacional);
$roteador->registrar('GET', '/movimentacoes/novo', [MovimentacaoController::class, 'formulario'], $guardOperacional);
$roteador->registrar('POST', '/movimentacoes/salvar', [MovimentacaoController::class, 'salvar'], $guardOperacional);

// Despachar a requisição
$roteador->despachar($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
?>