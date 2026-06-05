## 1. Banco de Dados e Modelo de Usuário

- [x] 1.1 Criar migração para adicionar `role` (string, default 'user') e `is_active` (boolean, default true) à tabela `users`
- [x] 1.2 Criar enum `App\Enums\UserRole` com casos `Admin` e `User`
- [x] 1.3 Atualizar `User` model: adicionar `role` e `is_active` em `$fillable`, cast `role` para `UserRole`, adicionar método helper `isAdmin()`
- [x] 1.4 Atualizar `UserFactory` para suportar estados `admin()` e `inactive()`
- [x] 1.5 Criar `DatabaseSeeder` com usuário admin padrão (admin@example.com / password)

## 2. Autenticação

- [x] 2.1 Criar controller `AuthController` com métodos `showLogin`, `login`, `logout`
- [x] 2.2 Criar layout de autenticação `resources/views/components/layouts/auth.blade.php`
- [x] 2.3 Criar view `resources/views/auth/login.blade.php` com formulário de login (e-mail, senha, lembrar de mim)
- [x] 2.4 Adicionar rotas de autenticação em `routes/web.php` (GET /login, POST /login, POST /logout)
- [x] 2.5 Validar credenciais inválidas e usuário inativo com mensagens em PT-BR
- [x] 2.6 Redirecionar para `/dashboard` após login e `/login` após logout

## 3. Controle de Acesso por Papel

- [x] 3.1 Criar middleware `EnsureUserIsAdmin` que retorna 403 para usuários sem papel `Admin`
- [x] 3.2 Registrar middleware como alias `admin` em `bootstrap/app.php`
- [x] 3.3 Criar `BladeServiceProvider` (ou adicionar em `AppServiceProvider`) com diretiva `@role('admin')` / `@endrole`
- [x] 3.4 Criar `config/menu.php` com estrutura de itens: `label`, `route`, `icon`, `role`, `children`
- [x] 3.5 Escrever testes: acesso negado para User em rota admin, acesso permitido para Admin

## 4. Layout Administrativo

- [x] 4.1 Implementar navbar `resources/views/components/layouts/partials/navbar.blade.php` com nome do usuário e dropdown (Meu Perfil, Sair)
- [x] 4.2 Implementar sidebar `resources/views/components/layouts/partials/sidebar.blade.php` renderizando itens de `config/menu.php` com filtro por papel
- [x] 4.3 Adicionar lógica de item ativo na sidebar baseado na rota atual (`request()->routeIs()`)
- [x] 4.4 Implementar suporte a subitens (dropdown de 2 níveis) na sidebar
- [x] 4.5 Criar componente Blade `x-breadcrumbs` que aceita array de itens e renderiza no cabeçalho de conteúdo
- [x] 4.6 Atualizar `app.blade.php` para incluir `@livewireScripts` e estrutura de toast notification

## 5. Componentes Base

- [x] 5.1 Criar componente Blade `x-form.text-input` (label, name, type, value, placeholder, erro de validação)
- [x] 5.2 Criar componente Blade `x-form.select` (label, name, options, selected, erro de validação)
- [x] 5.3 Criar componente Blade `x-form.textarea` (label, name, rows, value, erro de validação)
- [x] 5.4 Criar componente Livewire `Components/ConfirmModal` com evento `confirm-action` e slots de título/mensagem
- [x] 5.5 Criar componente Alpine.js de toast no layout principal: ouve evento `notify` e exibe notificação temporária (4s) com tipos success/error/warning

## 6. Dashboard

- [x] 6.1 Criar componente Livewire `Dashboard/MetricCard` com props: título, valor, ícone, cor
- [x] 6.2 Criar componente Livewire full-page `Dashboard/Index` que compõe 4 MetricCards (Total Usuários, Ativos, Admins, Inativos)
- [x] 6.3 Adicionar rota `/dashboard` apontando para o componente Livewire `Dashboard/Index` com middleware `auth`
- [x] 6.4 Atualizar rota raiz `/` para redirecionar para `/dashboard`

## 7. Módulo de Usuários

- [x] 7.1 Criar componente Livewire full-page `Users/Index` com tabela de usuários, busca em tempo real, paginação de 15 e colunas: Nome, E-mail, Papel, Status, Ações
- [x] 7.2 Criar componente Livewire full-page `Users/Create` com formulário de criação (nome, e-mail, papel, senha, confirmação de senha)
- [x] 7.3 Criar componente Livewire full-page `Users/Edit` com formulário de edição (senha opcional — em branco não altera)
- [x] 7.4 Implementar ação `toggleActive` no `Users/Index` com validação para impedir admin de inativar a si mesmo
- [x] 7.5 Adicionar rotas `/users` (index, create, edit) em grupo com middlewares `auth` e `admin`
- [x] 7.6 Atualizar `config/menu.php` para incluir item "Usuários" com `role => 'admin'`
- [x] 7.7 Escrever testes: listagem, criação, edição, ativação/inativação, proteção de acesso

## 8. Perfil do Usuário

- [x] 8.1 Criar componente Livewire full-page `Profile/Edit` com seção de dados pessoais (nome, e-mail) e seção de alteração de senha
- [x] 8.2 Implementar validação de senha atual antes de permitir a alteração
- [x] 8.3 Adicionar rota `/profile` com middleware `auth` (acessível para todos os papéis)
- [x] 8.4 Adicionar link "Meu Perfil" no dropdown da navbar apontando para `/profile`
- [x] 8.5 Escrever testes: atualização de dados, troca de senha com senha atual correta/incorreta

## 9. Localização e Configuração Final

- [x] 9.1 Publicar e configurar o arquivo de idioma PT-BR do Laravel para mensagens de validação
- [x] 9.2 Configurar `config/app.php`: `locale => 'pt_BR'`, `timezone => 'America/Sao_Paulo'`
- [x] 9.3 Executar `php artisan migrate` e `php artisan db:seed` para validar o setup completo
- [x] 9.4 Executar `vendor/bin/pint` para garantir estilo de código consistente
- [x] 9.5 Executar suite de testes completa (`php artisan test`) e garantir que tudo passa
