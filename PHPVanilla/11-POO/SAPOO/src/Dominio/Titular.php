<?php 
declare(strict_types=1);
// Classe para representar atributos e metódos do titular da conta bancária

final class Titular {
    // Usar o property promotion para declarar os atributos dentro do construtor
    // Construtor 
    public function __construct(
        // Propriedade readonly => garante imutabilidade nativa pelo PHP
        public readonly string $nome,
        public readonly string $cpf
    )
    {
        $this->validarDados();
    }

    // Criar o método de validação dos dados
    private function validarDados() : void {
        if(strlen(trim($this->nome)) < 3) {
            throw new InvalidArgumentException("O nome do titular deve possuir no mínimo 3 caracteres");
        }

        // Substituir valores não númericos no cpf por nada ""
        $cpfNumeros = preg_replace("/\D/", "",  $this->cpf); // Apenas números

        if(strlen($cpfNumeros) != 11) {
            throw new InvalidArgumentException("O CPF deve conter exatamente 11 digítos numéricos");
        }
    }
}


?>