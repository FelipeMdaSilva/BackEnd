<?php 
declare(strict_types=1);

use DomainException; // Import da bibilioteca do PHP de erros chamado Domain Exception

// Classe base para erros das regras de negócio
class ContaException extends DomainException { // Herança da base de erros do sistema
    // Declaração do Construtor usando Propery Promotion
    #[Override]
    public function __construct(string $message = "Falha na Operação Bancária!")
    {
        parent::__construct($message);
    }
}

?>