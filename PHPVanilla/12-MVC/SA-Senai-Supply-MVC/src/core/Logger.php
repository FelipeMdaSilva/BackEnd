<?php 
declare(strict_types=1);

namespace App\Core;

// Serviço de centralização de logs corporativos para persistência na raiz do sistema

final class Logger {
    // Registrar eventos de Log para Auditoria
    // Função para gravar no arquivo de log
    private static function gravar(string $nivel, string $mensagem, array $contexto): void {
        $caminhoDir = dirname(__DIR__, 2) . "/logs";
        if(!is_dir($caminhoDir)) {
            // Se não existir o arquivo crie o arquivo
            mkdir($caminhoDir, 0755, true);
        }
        $ip = $_SERVER['REMOTE_ADDR'] ?? "CLI"; // Pega ip do usuário
        $dataHora = date("Y-m-d H:i:s"); // Pega data e hora
        $detalhe = !empty($contexto) ? " " . json_encode($contexto, JSON_UNESCAPED_UNICODE) : ""; // Transforma a string contexto em json
        $linha = sprintf("[%s] [%s] [IP: %s] %s%s%s", $dataHora, $nivel, $ip, $mensagem, $detalhe, PHP_EOL);
        file_put_contents($caminhoDir . '/app.log', $linha, FILE_APPEND | LOCK_EX);
    }

    // Criar metódos para identificação de logs

    // Registrar eventos informativos de auditoria
    public static function info(string $mensagem, array $contexto=[]): void {
        self::gravar("INFO", $mensagem, $contexto);
    }

    // Registro de avisos - Violações de regras de negócio
    public static function aviso(string $mensagem, array $contexto=[]): void {
        self::gravar("AVISO", $mensagem, $contexto);
    }

    // Registro de falha de erro - execução crítica 
    public static function erro(string $mensagem, array $contexto=[]): void {
        self::gravar("ERRO", $mensagem, $contexto);
    }

    // OBS: métodos ou atributos "static" são executados ou chamados diretamente pela classe, sem a necessidade de instanciar um objeto. Podemos fazer uma analogia a um objeto descartavel, serve apenas para única tarefa e depois é jogado fora, evitando ocupar espaço na memória
}
?>