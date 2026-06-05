## ADDED Requirements

### Requirement: Usuário logado pode editar seu próprio nome e e-mail
O sistema SHALL permitir que qualquer usuário autenticado atualize seu nome e e-mail na página de perfil.

#### Scenario: Atualização de nome bem-sucedida
- **WHEN** usuário altera o nome e salva
- **THEN** sistema persiste a alteração e exibe toast de sucesso

#### Scenario: E-mail duplicado ao editar perfil
- **WHEN** usuário tenta salvar um e-mail já usado por outro usuário
- **THEN** sistema exibe erro "O e-mail já está em uso." sem persistir a alteração

### Requirement: Usuário logado pode alterar sua própria senha
O sistema SHALL permitir que o usuário altere a senha, exigindo a confirmação da senha atual.

#### Scenario: Troca de senha bem-sucedida
- **WHEN** usuário informa a senha atual correta, a nova senha e a confirmação, e salva
- **THEN** sistema atualiza a senha e exibe toast de sucesso

#### Scenario: Senha atual incorreta
- **WHEN** usuário informa senha atual errada
- **THEN** sistema exibe erro "A senha atual está incorreta." sem alterar a senha

#### Scenario: Nova senha não confere com confirmação
- **WHEN** nova senha e confirmação são diferentes
- **THEN** sistema exibe erro de validação antes de submeter

### Requirement: Página de perfil acessível para todos os usuários autenticados
O sistema SHALL tornar a rota `/profile` acessível a qualquer usuário autenticado, independente do papel.

#### Scenario: Admin acessa o perfil
- **WHEN** usuário Admin acessa `/profile`
- **THEN** sistema exibe a página de perfil

#### Scenario: Usuário comum acessa o perfil
- **WHEN** usuário com papel User acessa `/profile`
- **THEN** sistema exibe a página de perfil
