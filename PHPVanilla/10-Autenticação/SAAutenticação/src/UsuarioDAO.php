<?php 
declare(strict_types=1);

// Isolar as operações de busca e cadastro de usuários 
// Nessa camada é aplicado o hash de senha `password_hash()`;
final class UsuarioDAO{
    // Atributos
    private PDO $pdo; // Atributo de conexão com o banco

    // Constructor -> Permite instanciar objeto desta classe
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Métodos
    // Cadastrar => Com Criptografia
    public function cadastrar (
        string $nome, string $email, string $senha, 
        string $perfil = "OPERADOR"): bool {

        $sql = "INSERT INTO usuarios(nome, email, senha_hash, perfil) VALUES (:nome, :email, :hash, :perfil)";
        $stmt = $this->pdo->prepare($sql);
        // Fazer o algoritmo de hash da senha
        $algoritmo = defined("PASSWORD_ARGON2ID") ? PASSWORD_ARGON2ID : PASSWORD_BCRYPT;
        $hash = password_hash($senha, $algoritmo); // Vai criar a senha criptografada
        return $stmt->execute([
            ":nome"     => trim($nome),
            ":email"    => strtolower(trim($email)),
            ":hash"     => $hash,
            ":perfil"   => $perfil
        ]);
        }

        // Buscar por email
        public function buscarPorEmail (string $email): ?array {

            $sql = "SELECT * FROM usuarios WHERE email = :email AND ativo = TRUE";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":email", strtolower(trim($email)), PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ?: null;
        }

        // Verificar se email existe => Evitar dois cadastros com o mesmo email
        public function emailExiste(string $email): bool {
            $sql = "SELECT 1 FROM usuarios WHERE email = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":email", strtolower(trim($email)), PDO::PARAM_STR);
            $stmt -> execute();

            return (bool) $stmt->fetchColumn(); //(bool) -> CAST => garante que o retorno da informação vai ser uma booleana
        }
};

?>