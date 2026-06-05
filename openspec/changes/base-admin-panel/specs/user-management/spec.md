## ADDED Requirements

### Requirement: Listagem de usuários com busca e paginação
O sistema SHALL exibir todos os usuários em uma tabela com busca por nome/e-mail e paginação de 15 itens por página.

#### Scenario: Listagem sem filtro
- **WHEN** admin acessa `/users`
- **THEN** sistema exibe tabela com colunas: Nome, E-mail, Papel, Status, Ações

#### Scenario: Busca por nome
- **WHEN** admin digita um termo no campo de busca
- **THEN** tabela filtra em tempo real (Livewire) e exibe apenas usuários cujo nome ou e-mail contenha o termo

#### Scenario: Paginação
- **WHEN** existem mais de 15 usuários
- **THEN** sistema exibe paginação abaixo da tabela

### Requirement: Criação de novo usuário
O sistema SHALL permitir que admins criem novos usuários informando nome, e-mail, papel e senha.

#### Scenario: Criação com dados válidos
- **WHEN** admin preenche formulário com dados válidos e submete
- **THEN** sistema cria o usuário, exibe toast de sucesso e redireciona para listagem

#### Scenario: E-mail duplicado
- **WHEN** admin tenta criar usuário com e-mail já existente
- **THEN** sistema exibe erro de validação "O e-mail já está em uso." sem criar o usuário

### Requirement: Edição de usuário existente
O sistema SHALL permitir que admins editem nome, e-mail, papel e senha de qualquer usuário.

#### Scenario: Edição bem-sucedida
- **WHEN** admin altera o nome do usuário e salva
- **THEN** sistema persiste a alteração e exibe toast de sucesso

#### Scenario: Senha em branco não altera a senha
- **WHEN** admin salva o formulário de edição com o campo senha em branco
- **THEN** sistema atualiza apenas os outros campos, sem alterar a senha do usuário

### Requirement: Ativar e inativar usuário
O sistema SHALL permitir que admins alternem o status `is_active` de qualquer usuário, exceto o próprio admin logado.

#### Scenario: Inativação de usuário ativo
- **WHEN** admin clica em "Inativar" para um usuário ativo
- **THEN** sistema define `is_active = false` e exibe status "Inativo" na tabela

#### Scenario: Admin não pode inativar a si mesmo
- **WHEN** admin tenta inativar sua própria conta
- **THEN** sistema exibe erro "Você não pode desativar sua própria conta."

### Requirement: Apenas admins acessam o módulo de usuários
O sistema SHALL proteger todas as rotas de `/users` com o middleware `EnsureUserIsAdmin`.

#### Scenario: Acesso negado para usuário comum
- **WHEN** usuário com papel `User` acessa `/users`
- **THEN** sistema retorna HTTP 403
