## ADDED Requirements

### Requirement: Usuário não autenticado é redirecionado para login
O sistema SHALL redirecionar para `/login` qualquer acesso a rotas protegidas por usuário não autenticado.

#### Scenario: Acesso direto a rota protegida sem sessão
- **WHEN** usuário tenta acessar `/dashboard` sem estar logado
- **THEN** sistema redireciona para `/login`

### Requirement: Login com credenciais válidas
O sistema SHALL autenticar o usuário e redirecionar para o dashboard quando as credenciais forem corretas.

#### Scenario: Login bem-sucedido
- **WHEN** usuário preenche e-mail e senha corretos e submete o formulário
- **THEN** sistema cria a sessão e redireciona para `/dashboard`

### Requirement: Login com credenciais inválidas
O sistema SHALL exibir mensagem de erro quando as credenciais forem incorretas, sem revelar qual campo está errado.

#### Scenario: Senha incorreta
- **WHEN** usuário preenche e-mail existente com senha errada e submete
- **THEN** sistema exibe "As credenciais fornecidas estão incorretas." e não cria sessão

#### Scenario: E-mail não cadastrado
- **WHEN** usuário preenche e-mail inexistente e submete
- **THEN** sistema exibe "As credenciais fornecidas estão incorretas." e não cria sessão

### Requirement: Usuário inativo não pode fazer login
O sistema SHALL negar acesso a usuários com `is_active = false`.

#### Scenario: Login de usuário inativo
- **WHEN** usuário inativo submete credenciais corretas
- **THEN** sistema exibe "Sua conta está desativada." e não cria sessão

### Requirement: Logout encerra a sessão
O sistema SHALL destruir a sessão do usuário ao fazer logout.

#### Scenario: Logout bem-sucedido
- **WHEN** usuário autenticado acessa a ação de logout
- **THEN** sistema destrói a sessão e redireciona para `/login`

### Requirement: Layout de autenticação sem sidebar/navbar
O sistema SHALL exibir as telas de autenticação com layout próprio, sem os elementos do painel administrativo.

#### Scenario: Página de login sem layout admin
- **WHEN** usuário acessa `/login`
- **THEN** página exibe apenas o formulário de login, sem sidebar ou navbar
