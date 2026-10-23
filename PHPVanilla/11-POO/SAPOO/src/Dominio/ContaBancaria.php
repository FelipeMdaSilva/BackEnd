<?php 
declare(strict_types=1);

// Superclasse abstrata contendo o contrato e estados compartilhados entre as contas 

abstract class ContaBancaria {
    // Atributos do tipo protected (podem ser passados como herança)
    protected float $saldo;

    // Construtor
    public function __construct(
        public readonly string $agencia,
        public readonly string $numeroConta,
        public readonly Titular $titular,
        float $saldoInicial
    )
    {
        // Validação se o saldo inicial é maior que 0
        // Caso não for emite uma exception (ValorInvalidoException)
        if ($saldoInicial < 0.0) {
            throw new valorInvalidoException($saldoInicial);
        }
        $this->saldo = $saldoInicial;
    }

    // Métodos da classe
    // Depositar
    public function depositar(float $valor): void {
        if ($valor <= 0.0 ) {
            throw new valorInvalidoException($valor);
        }
        $this->saldo+=$valor;
    }

    // Método abstrato (polimorfismo)
    abstract public function sacar(float $valor): void;

    // Método polimorfico que realiza transferência entre contas
    public function transferir (float $valor, ContaBancaria  $contaDestino): void {
        if ($this === $contaDestino) {
            throw new valorInvalidoException($valor);
            }
            
        // Realizar a transferência => realiza o saque
        $this->sacar($valor);
        // Depois o deposito
        $contaDestino->depositar($valor);
    }

    // Método publico de acesso (getter)
    public function getSaldo():float {
        return $this->saldo;
    }
}

?>