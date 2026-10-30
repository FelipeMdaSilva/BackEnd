<?php 
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Produto;
use App\Models\Movimentacao;

final class HomeController extends Controller {
    // Subclasse de controller
    
    // Método index -> renderizar a tela home/index.php
    public function index(): void {
        $totalInsumos = Produto::totalInsumos();
        $totalEstoque = Produto::totalEstoque();
        $ultimasMovimentacoes = Movimentacao::listarHistorico(5);

        $this->renderizar("home/index.php", [
            "titulo"                => "Painel de Controle do Almoxarifado",
            "totalInsumo"           => $totalInsumos,
            "totalEstoque"          => $totalEstoque,
            "ultimasMovimentacoes"  => $ultimasMovimentacoes 
        ]);
    }
}

?>