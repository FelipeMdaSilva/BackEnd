## Exercícios teóricos

1. O uso de arrays associativos e scripts procedurais para gerenciar regras financeiras críticas apresenta três principais riscos técnicos: a total falta de tipagem e integridade, que abre espaço para corrupção silenciosa de dados; a ausência de encapsulamento, permitindo que qualquer trecho de código altere o estado financeiro sem validações de negócio; e o alto acoplamento com efeitos colaterais severos, tornando a manutenção complexa e inviabilizando testes automatizados confiáveis.

2. Quando a instrução `new ContaCorrente(...)` é executada, o servidor aloca um bloco de memória na Heap para armazenar os atributos e métodos da instância, retornando um ponteiro/referência para a variável, e o método `__construct()` roda em seguida para inicializar o objeto com um estado válido.

3. O uso de `$this->saldo` é obrigatório porque `$this` aponta para a instância atual na Heap, permitindo ler ou alterar o estado persistente do objeto, enquanto uma variável local `$saldo` existe apenas temporariamente no escopo da função e é destruída ao término da execução.

4. Um desenvolvedor sênior nunca deve criar um método `public function setSaldo(float $novoSaldo)` porque isso expõe o estado a alterações externas arbitrárias, violando as invariantes de negócio e a integridade financeira, exigindo que alterações ocorram apenas através de métodos comportamentais explícitos como `depositar()` ou `sacar()`.

5. A diferença prática entre `private` e `protected` é que membros `private` pertencem exclusivamente à classe declarante e são invisíveis para subclasses, enquanto membros `protected` permitem acesso direto pelas classes filhas.

6. A promoção de propriedades no PHP 8 reduz o código boilerplate ao permitir declarar, tipar e inicializar atributos diretamente nos parâmetros do construtor, eliminando a repetição manual.

7. Atributos `readonly` garantem segurança e imutabilidade em objetos de valor como Titular ou CPF, permitindo que o valor seja atribuído apenas uma vez e bloqueando qualquer modificação posterior.

8. É correto tornar a classe `ContaBancaria` abstrata porque ela representa um conceito genérico que não deve ser instanciado diretamente, servindo apenas para centralizar regras comuns para as contas concretas filhas.

9. O método `transferir` consegue operar com quaisquer contas filhas sem conhecer a classe exata graças ao polimorfismo e ao typehinting da classe pai, confiando que o objeto passado cumpre o contrato compartilhado.

10. Retornar `false` ou `null` em saques negados é uma péssima prática pois obriga o código cliente a checar respostas manualmente, o que gera fluxos frágeis, enquanto o lançamento de exceções de domínio interrompe falhas de forma segura, explícita e auditável.