<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

// Classe responsável pela gestão dos models em relação a interface visual

class AtivoController extends Controller
{
    // Método para gerar um painel principal de ativos
    public function index(): View{
        $metricas = [
            "totalAtivos"   => 42,
            "emOperacao"    => 37,
            "emManutencao"  => 4,
            "parados"       => 1,
            "taxaEficiencia"=> 88,5
        ];

        return view("ativos.index", [
            "metricas" => $metricas,
            "titulo"   => "Painel Geral de Ativos Industriais"
        ]);
    }

    // Método para verificar o status e diagnostico do servidor em formato json
    public function status(): JsonResponse {
        return response()->json([
            "plataforma"  => config("app.name"),
            "ambiente"    => config("app.env"),
            "version_php" => PHP_VERSION,
            "status"      => "ONLINE",
            "timestamp"   => now()->toIso8601String()   
        ]);
    }
}
