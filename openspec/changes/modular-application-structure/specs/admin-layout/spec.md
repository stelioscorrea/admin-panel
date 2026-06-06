## MODIFIED Requirements

### Requirement: Layout inicializa corretamente os componentes JavaScript do Bootstrap
O sistema SHALL importar o pacote JavaScript do Bootstrap 5 (incluindo Popper.js) no entry point `resources/js/app.js` para que todos os componentes Bootstrap interativos funcionem corretamente.

#### Scenario: Dropdown do usuário abre ao clicar
- **WHEN** o usuário autenticado clica no item do Navbar com seu nome
- **THEN** o sistema SHALL exibir o menu dropdown com as opções "Meu Perfil" e "Sair"

#### Scenario: Dropdown fecha ao clicar fora
- **WHEN** o dropdown está aberto e o usuário clica fora dele
- **THEN** o sistema SHALL fechar o dropdown automaticamente

#### Scenario: Link de perfil navega para a página de perfil
- **WHEN** o usuário clica em "Meu Perfil" no dropdown
- **THEN** o sistema SHALL navegar para a rota `profile`

#### Scenario: Botão Sair realiza logout
- **WHEN** o usuário clica em "Sair" no dropdown
- **THEN** o sistema SHALL submeter o formulário de logout e encerrar a sessão

## ADDED Requirements

### Requirement: Route registration delegated to modules
The `routes/web.php` file SHALL only contain global routes (root redirect, authentication routes, logout). All feature routes (dashboard, users, profile) SHALL be registered by their respective module `routes.php` files loaded automatically in `AppServiceProvider::boot()`.

#### Scenario: Feature routes disappear from web.php after migration
- **WHEN** `routes/web.php` is inspected
- **THEN** it SHALL NOT contain route definitions for `/dashboard`, `/profile`, or `/users`

#### Scenario: All application routes remain functional after migration
- **WHEN** `php artisan route:list` is run after the migration
- **THEN** all routes (`dashboard`, `profile`, `users.index`, `users.create`, `users.edit`, `login`, `logout`) SHALL be listed with the same URIs and names as before
