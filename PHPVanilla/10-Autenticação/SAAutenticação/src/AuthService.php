<?php 
declare(strict_types=1);

// Serviço responsável pelo controle e segurança das sessões HTTP

final class AuthService {
    // Atributo -> Regra de Negócio
    private const TEMPO_INATIVIDADE_SEG = 900; // 15 minutos de inatividade o usuário precisa fazer um novo login

    // Métodos (static) => Não precisa instanciar objeto para usar os métodos
    public static function iniciarSessaoSegura(): void {
        // Verificar se existe não existe uma sessão aberta
        if(session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params([
                "lifetime"  => 0,
                "path"      => "/",
                "httponly"  => true,
                "samesite"  => "Lax"
            ]);
            // Inicia a session
            session_start();
        }

    }
        
    // Depois de iniciar a sessão => preciso armazenar as informações do usuário na superglobal $_SESSION
    public static function autenticar(array $usuario): void {
        self::iniciarSessaoSegura();
        // Deletar as sessões antigas
        session_regenerate_id(true);

        // Guardando as informações do usuário na superglobal
        $_SESSION["usuario_id"]         = (int) $usuario["id"];
        $_SESSION["usuario_nome"]       = (string) $usuario["nome"];
        $_SESSION["usuario_email"]      = (string) $usuario["email"];
        $_SESSION["usuario_perfil"]     = (string) $usuario["perfil"];
        $_SESSION["ultimo_acesso"]      = time();
    }

    // Validar se a sessão excedeu o limite de inatividade
    public static function verificarExpiracao(): bool {
        self::iniciarSessaoSegura();
        // Se não tiver sessão, então inicia (direciona para login)
        if(!isset($_SESSION["ultimo_acesso"])) {
            return true;
        }
        // Se estiver fora do tempo de 15 minutos, destroi a sessão e redireciona para login
        if (time() - $_SESSION["ultimo_acesso"] > self::TEMPO_INATIVIDADE_SEG) {
            self::destruirSessao();
            return true;
        }
        // se estiver dentro do tempo continua o jogo, não precisa fazer login
        $_SESSION["ultimo_acesso"] = time();
        return false;
    }

    // Funcão para destruir a sessão atual (logout ou quando passar os 15 minutos)
    public static function destruirSessao(): void {
        self::iniciarSessaoSegura();
        $_SESSION = [];

        if (ini_get("session.user_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(), "", time()-42000, 
                $params["path"], $params["domain"], $params["secure"], $params["httponly"]
            );
        }
        session_destroy();  
    }
}
?>