## ADDED Requirements

### Requirement: Usuário possui um papel (role)
O sistema SHALL atribuir um papel a cada usuário: `Admin` ou `User`, representado pelo enum `UserRole`.

#### Scenario: Usuário criado com papel padrão
- **WHEN** um novo usuário é criado sem especificar papel
- **THEN** sistema atribui o papel `User` por padrão

### Requirement: Rotas administrativas requerem papel Admin
O sistema SHALL bloquear o acesso a rotas marcadas como admin para usuários com papel `User`.

#### Scenario: Usuário comum tenta acessar rota admin
- **WHEN** usuário com papel `User` tenta acessar `/users`
- **THEN** sistema retorna HTTP 403 (Forbidden)

#### Scenario: Admin acessa rota admin
- **WHEN** usuário com papel `Admin` acessa `/users`
- **THEN** sistema permite o acesso normalmente

### Requirement: Menu da sidebar filtra itens por papel
O sistema SHALL exibir na sidebar apenas os itens de menu que o usuário tem permissão de acessar.

#### Scenario: Sidebar para usuário Admin
- **WHEN** usuário com papel `Admin` está autenticado
- **THEN** sidebar exibe todos os itens incluindo "Usuários"

#### Scenario: Sidebar para usuário comum
- **WHEN** usuário com papel `User` está autenticado
- **THEN** sidebar não exibe o item "Usuários"

### Requirement: Diretiva Blade @role controla visibilidade de elementos
O sistema SHALL fornecer a diretiva `@role('admin')` para ocultar elementos de interface por papel.

#### Scenario: Elemento visível apenas para admin
- **WHEN** view usa `@role('admin')` em torno de um botão e o usuário logado é Admin
- **THEN** botão é renderizado no HTML

#### Scenario: Elemento oculto para não-admin
- **WHEN** view usa `@role('admin')` em torno de um botão e o usuário logado é User
- **THEN** botão não é renderizado no HTML
