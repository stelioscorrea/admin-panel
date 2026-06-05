## Context

O projeto é um boilerplate Laravel 13 + Livewire 4 + AdminLTE 4 que será clonado para futuros sistemas. A base técnica (Vite, SCSS, Pest, Livewire) já existe. Faltam: autenticação, controle de acesso, módulos funcionais e componentes reutilizáveis. Por ser um template, cada decisão de arquitetura tem peso maior — ela se replica em todos os projetos derivados.

## Goals / Non-Goals

**Goals:**
- Autenticação nativa Laravel (session-based) sem pacotes extras
- Controle de acesso por papel simples via enum UserRole (Admin, User)
- Módulo de usuários completo com Livewire (CRUD + ativar/inativar)
- Perfil do usuário logado (nome, e-mail, senha)
- Dashboard com widgets Livewire reutilizáveis
- Layout AdminLTE completo: navbar, sidebar dinâmica, breadcrumbs
- Biblioteca de componentes base: tabela com busca/paginação, modal, toasts
- Localização PT-BR desde o início
- Seeder com admin padrão para onboarding imediato
- Zero dependências Composer além das já existentes

**Non-Goals:**
- Autenticação via OAuth / redes sociais
- Permissões granulares por recurso (Spatie/Permission)
- API REST ou autenticação via token
- Gráficos/charts no dashboard (mantém leve para o template)
- Multi-tenancy
- 2FA

## Decisions

### 1. Autenticação: nativa Laravel vs. Laravel Breeze/Jetstream

**Decisão:** Implementar manualmente com `Auth::attempt()`, sem scaffolding de terceiros.

**Rationale:** Breeze/Jetstream geram código que conflita com o layout AdminLTE e adicionam opiniões sobre Tailwind/Inertia que não se encaixam no template. O controle manual é mais simples, mais transparente e não introduz dependências desnecessárias.

**Alternativa considerada:** Laravel Breeze — descartado por gerar views Tailwind incompatíveis com o layout AdminLTE existente.

### 2. Controle de acesso: enum UserRole vs. Spatie/Permission

**Decisão:** Enum PHP nativo `UserRole { Admin, User }` com coluna `role` no modelo User.

**Rationale:** Para um boilerplate com dois papéis fixos, Spatie/Permission é overhead desnecessário (tabelas extras, policies complexas, curva de aprendizado). O enum é tipado, testável, e pode ser expandido facilmente nos projetos filhos caso necessário.

**Alternativa considerada:** Spatie/Permission — descartado por adicionar dependência que pode não ser adequada para todos os sistemas derivados.

### 3. Layout de autenticação: separado do layout admin

**Decisão:** Criar `resources/views/components/layouts/auth.blade.php` específico para login, sem sidebar/navbar.

**Rationale:** Login é uma tela fora do contexto autenticado. Misturar layouts cria problemas de UX e lógica condicional desnecessária no layout principal.

### 4. Sidebar: array de configuração vs. hardcoded

**Decisão:** Array de configuração em `config/menu.php` que renderiza os itens da sidebar com suporte a ícone, rota, role requerida e subitens.

**Rationale:** Hardcoded não escala nem para o boilerplate nem para projetos derivados. O array de configuração é simples de entender e fácil de estender sem tocar em Blade.

### 5. Componentes Livewire: Full-page vs. Embedded

**Decisão:** Módulos de listagem (tabela de usuários) são componentes Livewire full-page. Widgets do dashboard são componentes embedded.

**Rationale:** Full-page simplifica roteamento (a rota aponta direto para o componente). Embedded faz sentido para widgets que compõem a página do dashboard.

### 6. Toasts: Alpine.js vs. JavaScript puro vs. pacote

**Decisão:** Implementar via evento Livewire + Alpine.js (`$wire.dispatch` + `x-on:notify`).

**Rationale:** Alpine.js já está disponível via Livewire. Não adiciona nenhuma dependência e mantém a notificação reativa ao ciclo de vida Livewire.

### 7. Tabela base: componente Livewire reutilizável

**Decisão:** Criar `app/Livewire/Components/DataTable.php` como componente base que outros podem estender, com `$search`, `$perPage`, `$sortBy`, `$sortDir` como propriedades padronizadas.

**Rationale:** Todos os sistemas derivados terão tabelas. Padronizar o comportamento (busca, paginação, ordenação) desde o boilerplate evita reescritas e inconsistências.

## Risks / Trade-offs

- **Sidebar via config/menu.php** → pode ficar limitada para menus muito complexos (ex: 3 níveis). Mitigação: o boilerplate suporta até 2 níveis (item + subitens); projetos que precisarem de mais podem refatorar.
- **Enum UserRole simples** → projetos que crescerem para permissões granulares precisarão migrar. Mitigação: a estrutura é clara o suficiente para que a migração para Spatie seja incremental e documentada.
- **Sem 2FA no boilerplate** → sistemas com requisitos de segurança elevados precisarão adicionar. Mitigação: fora do escopo intencional; a autenticação nativa Laravel suporta extensão com facilidade.
- **Componentes Livewire full-page** → requerem registro de rota explícita. Mitigação: convencionar que todas as rotas do painel ficam em `routes/panel.php` incluído em `web.php`.
