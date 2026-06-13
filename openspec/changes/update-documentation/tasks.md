## 1. Reescrever README.md

- [x] 1.1 Remover todo o conteúdo boilerplate do Laravel (seções "About Laravel", "Learning Laravel", "Agentic Development", "Contributing", "Code of Conduct", "Security Vulnerabilities", badges do framework)
- [x] 1.2 Adicionar cabeçalho com nome do projeto, descrição curta e badges relevantes (build status dos testes, PHP version, Laravel version)
- [x] 1.3 Adicionar seção "Stack" com as tecnologias: PHP 8.4, Laravel 13, Livewire 4, AdminLTE 4, Tailwind CSS 4, Bootstrap 5, SQLite, Vite 6
- [x] 1.4 Adicionar seção "Pré-requisitos" com PHP 8.4+, Composer, Node.js
- [x] 1.5 Adicionar seção "Setup" com os passos: clone, `composer setup` (ou passos manuais como fallback)
- [x] 1.6 Adicionar seção "Comandos Essenciais" com `composer dev`, `composer test`, `php artisan route:list`, `vendor/bin/pint`
- [x] 1.7 Adicionar seção "Arquitetura" descrevendo a estrutura modular (`app/Modules/`) com os 4 módulos atuais (Dashboard, Users, Profile, Components), o padrão de registro de aliases Livewire e o auto-load de rotas
- [x] 1.8 Adicionar seção "Funcionalidades" listando: autenticação, gerenciamento de usuários (CRUD + ativar/desativar), dashboard com métricas, perfil do usuário, controle de acesso por papel (admin/user)
- [x] 1.9 Adicionar seção "Testes" com instruções para rodar `php artisan test --compact`
- [x] 1.10 Adicionar seção "Licença" mantendo MIT

## 2. Atualizar GEMINI.md

- [x] 2.1 Atualizar a seção "Visão Geral do Projeto" para mencionar a estrutura modular (`app/Modules/`) e remover a referência a um layout "centralizado" que já não é o único ponto de organização
- [x] 2.2 Adicionar nota sobre o padrão de registro de componentes Livewire via `Livewire::component()` no `AppServiceProvider`
- [x] 2.3 Adicionar nota sobre o auto-load de rotas de módulos via glob em `AppServiceProvider::loadModuleRoutes()`
- [x] 2.4 Adicionar nota sobre onde adicionar novos módulos (criar `app/Modules/<Nome>/`, `Livewire/`, `routes.php` e registrar alias no `AppServiceProvider`)

## 3. Preencher SKILL.md

- [x] 3.1 Atualizar o frontmatter YAML: `name: admin-panel`, `description` com descrição real do projeto
- [x] 3.2 Escrever seção "When to use" descrevendo quando esta skill deve ser ativada (trabalho em qualquer módulo do admin panel)
- [x] 3.3 Escrever seção "Instructions" com as convenções específicas do projeto: estrutura de módulos, onde criar componentes Livewire, como registrar aliases, padrão de rotas por módulo e referência ao `AppServiceProvider`
