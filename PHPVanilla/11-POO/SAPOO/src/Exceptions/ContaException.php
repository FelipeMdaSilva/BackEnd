<?php 
declare(strict_types=1);

// Classe base para erros das regras de negócio
class ContaException extends DomainException { // Herança da base de erros do sistema
    // Declaração do Construtor usando Propery Promotion

    public function __construct(string $message = "Falha na Operação Bancária!")
    {
        parent::__construct($message);
    }
}

?>