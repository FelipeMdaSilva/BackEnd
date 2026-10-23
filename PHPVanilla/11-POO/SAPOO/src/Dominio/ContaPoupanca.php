<?php 
declare(strict_types=1);

// Classe ContaPoupanca
// Regras de Negócio => não tem limite e não tem taxa de saque, porém não permite sacar valores maiores que o disponivel no saldo

final class ContaPoupanca extends ContaBancaria {
    // Mantém o construtor
    // Não precisa declarar o construtor

    // Sobreescrita do método sacar
    public function sacar(float $valor): void
    {
        if ($valor <= 0.0) {
            throw new valorInvalidoException($valor);
        }
        // Verificar se valor é menor que o saldo
        if ($valor > $this->saldo) {
            throw new saldoInsuficienteException($this->saldo, $valor);
        }

        // Se tudo estiver certo
        $this->saldo -= $valor;
    }

    // Método de rendimentos da poupança
    public function renderJuros(float $percentual): void {
        if ($percentual <= 0.0) {
            throw new valorInvalidoException($percentual);
        }
        $rendimento = $this->saldo * ($percentual/100);
        $this->saldo += $rendimento;
    }
}
?>