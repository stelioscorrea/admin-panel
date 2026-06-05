## Why

Este projeto precisa de uma base administrativa completa e reutilizável para servir de template para futuros sistemas web. Atualmente existe apenas um scaffolding vazio — com AdminLTE instalado mas sem nenhuma funcionalidade real. Construir esse boilerplate agora garante consistência e velocidade de entrega nos projetos futuros.

## What Changes

- Implementar sistema de autenticação completo (login, logout, proteção de rotas)
- Adicionar controle de acesso por papel (Admin / User) sem dependências externas
- Construir módulo de gestão de usuários com Livewire (listagem, criação, edição, ativação/inativação)
- Criar página de perfil para o usuário logado (nome, e-mail, senha)
- Implementar dashboard com widgets de métricas reutilizáveis (Livewire)
- Completar layout AdminLTE: navbar funcional, sidebar dinâmica com links por role
- Criar biblioteca de componentes Blade/Livewire base: tabela com busca e paginação, modal de confirmação, toast notifications, breadcrumbs
- Configurar localização PT-BR (datas, validação, textos)
- Adicionar seeder com usuário admin padrão para onboarding imediato

## Capabilities

### New Capabilities

- `authentication`: Login/logout com layout dedicado, middleware de autenticação, "lembrar de mim"
- `role-access-control`: Enum UserRole (Admin, User), middleware EnsureUserIsAdmin, diretiva @role
- `user-management`: CRUD de usuários com Livewire — listagem paginada com busca, criação, edição, ativar/inativar
- `user-profile`: Página para o usuário logado editar seu próprio nome, e-mail e senha
- `dashboard`: Página inicial com cards de métricas Livewire e boas-vindas
- `admin-layout`: Navbar funcional, sidebar dinâmica configurável, links filtrados por role, marcação de item ativo
- `base-components`: Tabela Livewire reutilizável, modal de confirmação, toast notifications, breadcrumbs, form inputs padronizados

### Modified Capabilities

## Impact

- `app/Models/User.php`: adição de campo `role` e `is_active`, cast para enum `UserRole`
- `app/Http/Middleware/`: novos middlewares de autenticação e controle de role
- `app/Livewire/`: componentes para usuários, perfil, dashboard e tabela base
- `resources/views/`: layout de autenticação separado, componentes Blade novos, sidebar dinâmica
- `database/migrations/`: migração para adicionar `role` e `is_active` em `users`
- `database/seeders/`: seeder com admin padrão
- `routes/web.php`: rotas de auth, painel, usuários e perfil com middlewares corretos
- Nenhuma nova dependência Composer — tudo implementado nativamente com Laravel + Livewire
