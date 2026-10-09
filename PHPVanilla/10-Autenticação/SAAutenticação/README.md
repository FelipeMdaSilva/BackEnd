# Situação de Aprendizagem Usando Sessão, Cookies e Autenticaçao

## Estrutura do Projeto

Organize sua pasta exatamente com a seguinte árvore de arquivos

```text
SAAutenticacao/
├── config/
│   └── database.ini        <- Credenciais protegidas de acesso ao PostgreSQL
├── logs/
│   └── database.log        <- Logs do Banco de Dados
├── src/
│   ├── ConexaoBanco.php    <- Conexão Singleton PDO com PostgreSQL
│   ├── UsuarioDAO.php      <- Camada de persistência para consulta e cadastro
│   ├── AuthService.php     <- Serviço de gerenciamento de sessão e expiração
│   └── guard.php           <- Middleware interceptador de páginas restritas
├── schema.sql              <- Estrutura da tabela de usuários corporativos
├── login.php               <- Tela de autenticação pública
├── dashboard.php           <- Painel restrito protegido
├── logout.php              <- Encerramento seguro de sessão
└── README.md               <- Documentação do Projeto
```

## Criação da Tabela no Banco de Dados (PostgreSQL)

```sql
-- Criação da tabela de usuários corporativos com controle de perfil

CREATE TABLE IF NOT EXISTS usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    perfil VARCHAR(20) NOT NULL DEFAULT 'OPERADOR' CHECK (perfil IN ('ADMIN', 'OPERADOR')),
    ativo BOOLEAN NOT NULL DEFAULT TRUE,
    criado_em TIMESTAMP WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

```

## Configurar o Banco de Dados e criar a classe de conexão usando Singleton

Criar o arquivo .ini

```ini
; config/database.ini
[database]
db_driver   = pgsql
db_host     = 127.0.0.1
db_port     = 5432
db_name     = peca_senai
db_user     = postgres
db_pass     = postgres
```

## Camada de acesso a dados (`src/UsuarioDAO.php`)

Isolamos as operações de busca e cadastro de usuários em uma classe DAO

> OBS: Cadastro de usuário é realizado com a função `password_hash`

UsuarioDAO.php
- Cadastrar (com hash de senha);
- Busca por email (busca os dados do usuário)
- Verificar se email já existe no cadastro (bool)

## O serviço de autenticação (`src/AuthService.php`)

classe que ira criar o ciclo de vida da sessão do usuário: cookies e a sessão

> OBS: Classe do tipo static (não existe instanciamento de objetos)


AuthService.php

- iniciarSessaoSegura() -> passa as informações para o Cookie
- autenticar() -> passa as informações para a superglobal
- sessaoExpirada() -> verifica o tempo de inatividade
- sessionDestroy() -> finaliza a sessao e limpa os cookies do navegador

## MiddleWare Interceptador (`src/guard.php`)

Bloqueia visitantes não autenticados ou sessões expiradas

- Verificação de sessão 
- Verificação de expiração

## Criação das Telas

### Tela de Cadastro (`cadastro.php`)

