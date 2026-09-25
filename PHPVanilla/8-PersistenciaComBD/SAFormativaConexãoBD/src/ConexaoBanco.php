<?php 
declare(strict_types=1);

// Criar a classe responsável por fornecer uma instância unica de conexão usando PDO com o banco de dados (Singleton)

final class ConexaoBanco {
    // Atributos => São as caracteristicas do objeto
    private static ?PDO $instancia = null; // Muda de acordo com a conexão. Inicialmente é nulo, mas depois pode mudar para conectado
    
    // Métodos (ações que o objeto pode fazer)

    // Construtor
    private function __construct(){} // Construtor vazio e privado (técnica do Singleton)

    // Para garantia de segurança -> Bloqueio de clonagem // Desserialização

    private function __clone(): void {}
    private function __wakeup(): void {throw new \Exception("Desserialização não permitida no Singleton");}

    // Fazer a técnica de obterConexao PDO
    public static function obterConexao(string $caminhoConfig):PDO {
        // Só vou criar uma nova conexão se não existir outra
        if (self::$instancia === null) {
            // Vou criar uma conexão
            $config = self::carregarArquivoConfig($caminhoConfig);
            self::$instancia = self::estabelecerConexao($config);
        }
        return self::$instancia;
    }

    // Le e valida os parametros do arquivo de configuração, dados envelopados .ini ou .env
    private static function carregarArquivoConfig(string $caminho): array {
        if (!file_exists($caminho)) {
        throw new \RuntimeException("Arquivo de configuração não encontrado em : {$caminho}");
        }
        $dados = parse_ini_file($caminho, true);
        if ($dados === false || !isset($dados["database"])) {
            throw new \RuntimeException("Seção [database] ausente no arquivo de configuração");
        }
        return $dados["database"];
    }

    // Criar a instancia nativa do PDO aplicando as flags de segurança do PDO
    private static function estabelecerConexao(array $cfg): PDO {
        $dsn = sprintf(
            // "pgsql:host=127.0.0.1;port=5432;dbname=escola_biblioteca"
            "%s:host=%s;port=%s;dbname=%s",
            $cfg["db_driver"],
            $cfg["db_host"],
            $cfg["db_port"],
            $cfg["db_name"]
        );
        // Colocar as Flags do PDO
        $opcoes = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_TIMEOUT            => 5
        ];
        
        return new PDO($dsn, $cfg["db_user"], $cfg["db_pass"], $opcoes);
    }

    }
?>