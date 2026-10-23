<?php 
declare(strict_types=1);

// Classe conta corrente que é uma subclasse de ContaBancaria
// Regra de negócio => permite cheque especial (limite negativo)
// => taxa de saque -> R$ 1.50

final class ContaCorrente extends ContaBancaria {
    // Atributos não declarados em conta bancaria
    public const TARIFA_SAQUE = 1.50;

    // Reescrevendo o método da superclasse
    public function __construct(
        string $agencia,
        string $numeroConta,
        Titular $titular,
        float $saldoInicial = 0.0,
        private float $limiteChequeEspecial = 500.00)
    {
        return parent::__construct($agencia, $numeroConta, $titular, $saldoInicial);
    }

    // Obrigatoriedade de implementar o método sacar (método polimorfico)
    public function sacar(float $valor): void
    {
        if ($valor <= 0) {
            throw new valorInvalidoException($valor);
        }
        $custoTotal = $valor + self::TARIFA_SAQUE;
        $saldoTotalDisponivel = $this->saldo + $this->limiteChequeEspecial;

        if ($custoTotal > $saldoTotalDisponivel) {
            throw new saldoInsuficienteException($saldoTotalDisponivel, $custoTotal);
        }
        $this->saldo -= $custoTotal;
    }

    // Método de acesso do cheque especial 
    public function getLimiteChequeEspecial(): float {
        return $this->limiteChequeEspecial;
    }
}
?>