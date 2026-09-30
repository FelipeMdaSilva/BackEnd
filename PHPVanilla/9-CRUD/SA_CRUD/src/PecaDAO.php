<?php
declare(strict_types=1);

// Camada de acessoa a dados (DAO) para almoxarifado de peças
// Esta camada sera uma classe de conexão usando POO (Programação orientada ao Objeto)

final class PecaDAO {
    // Atributos da classe
    private PDO $pdo;
    
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
    
}