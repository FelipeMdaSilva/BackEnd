<?php
declare(strict_types=1);

// Camada de acessoa a dados (DAO) para almoxarifado de peças
// Esta camada sera uma classe de conexão usando POO (Programação orientada ao Objeto)

final class PecaDAO {
    // Atributos da classe
    private PDO $pdo; // => Atributo que irá disponibilizar a conexão com o banco de dados
    
    // Métodos da classe
    // construtor -> é o método que permite criar objetos desta classe
    public function __construct(PDO $pdo) {
        // Ao chamar o construtor estou atribuindo um valor ao atributo declarado anteriormente
        $this->pdo = $pdo;
    }
    // Para criar um objeto da classe PecaDAO é necessário já possuir uma conexão estabelecida com o banco de dados, conexão essa criada anteriormente na classe ConexaoBanco

    // Criar os métodos do CRUD 
    // READ -> listar todas as peças em ordem decrescente
    public function listarTodos(): array {
        $sql = "SELECT * FROM pecas_industriais ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Criar uma lista de produtos associando os valores ao nomes das colunas do banco de dados
    }
    // READ -> Listar objetos pelo ID
    public function buscarPorId(int $id): array {
        $sql = "SELECT * FROM pecas_industriais WHERE id= :id";
        // Se vai ter dados sendo inseridos pelo usuário
        $stmt = $this->pdo->prepare($sql);
        // Prepara o parâmetro de entrada usando bindValue()
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // READ -> Buscar por termo (filtro)
    public function buscarPorTermo(string $termo): array {
        $sql = "SELECT * FROM pecas_industriais 
        WHERE codigo_sku ILIKE :termo 
        OR descricao ILIKE :termo 
        OR categoria ILIKE :termo
        ORDER BY descricao ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":termo" => "%" .trim($termo) ."%"]);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // CREATE -> Cadastra nova peça no estoque
    public function salvar(array $dados): bool {
        $sql = "INSERT INTO pecas_industriais
                (codigo_sku, descricao, categoria, quantidade, preco_unitario)
                VALUES (:sku, :descricao, :categoria, :quantidade, :preco)";
        $stmt = $this->pdo->prepare($sql);
        $resultado = $stmt->execute([
            ":sku"          => strtoupper(trim($dados["codigo_sku"])),
            ":descricao"    => trim($dados["descricao"]),
            ":categoria"    => trim($dados["categoria"]),
            ":quantidade"   => (int)$dados["quantidade"], // (int) => cast de dados -> converte para formato numero o variavel
            ":preco"        => (float)$dados["preco_unitario"] // Cast => (float)
        ]);
        return $resultado; // Retornar se deu certo (true) ou não (false)
    }

    // UPDATE -> Atualizar um registro no banco
    public function atualizar(int $id, array $dados): bool {
    $sql = "UPDATE pecas_industriais 
            SET codigo_sku = :sku, 
            descricao      = :descricao, 
            categoria      = :categoria, 
            quantidade     = :quantidade, 
            preco_unitario = :preco 
            WHERE id       = :id";

        $stmt = $this->pdo->prepare($sql);

        $resultado = $stmt->execute([
            ":id"          => $id,
            ":sku"         => strtoupper(trim($dados["codigo_sku"])),
            ":descricao"   => trim($dados["descricao"]),
            ":categoria"   => trim($dados["categoria"]),
            ":quantidade"  => (int)$dados["quantidade"],
            ":preco"       => (float)$dados["preco_unitario"]
        ]);

        return $resultado;
    }

    // DELETE -> Excluir dados do banco
    public function excluir(int $id): bool {
        $sql = "DELETE FROM pecas_industriais WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $resultado = $stmt -> execute();
        return $resultado;
    }
}