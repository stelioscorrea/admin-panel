# Admin Panel - Gemini Instructions

Este projeto é um painel administrativo moderno construído com **Laravel 13**, **Livewire 4** e **AdminLTE 4**.

## ⚠️ Mandato Principal
Este projeto utiliza o **Laravel Boost**. Todas as interações devem seguir rigorosamente as diretrizes em **[AGENTS.md](./AGENTS.md)**.
- **Skills:** Ative sempre as skills em `.agents/skills/` conforme a área de atuação.
- **MCP:** Utilize o servidor MCP `laravel-boost` para ferramentas de banco de dados e documentação.

## Visão Geral do Projeto
- **Stack:** PHP 8.4, Laravel 13, Livewire 4, AdminLTE 4, Tailwind CSS 4.
- **Layout:** Centralizado em `resources/views/layouts/app.blade.php`.
- **Database:** SQLite por padrão no desenvolvimento.

## Comandos Essenciais

### Configuração e Execução
- `composer setup`: Instala tudo e prepara o ambiente.
- `composer dev`: Inicia servidor, queue, logs e Vite simultaneamente.

### Testes e Estilo
- `composer test`: Executa a suite de testes.
- `vendor/bin/pint`: Formata o código conforme o padrão do projeto.

### Commits
- **Teste antes de Commit:** Sempre execute `php artisan test` antes de gerar um commit.
- **Mensagens:** Gere mensagens apenas se os testes passarem, seguindo o padrão **Conventional Commits**.

## Convenções de Desenvolvimento
- **Agentic Workflow:** Antes de qualquer mudança de código, use `search-docs` (via MCP) para validar a abordagem.
- **Modern PHP:** Use atributos para configuração de models (ex: `#[Fillable]`) e *constructor property promotion*.
- **Frontend:** Componentes Livewire são preferidos para interatividade.
- **Estilização:** AdminLTE fornece a base; Tailwind 4 é usado para ajustes finos.

Para detalhes completos de arquitetura e regras de codificação, consulte o arquivo **[AGENTS.md](./AGENTS.md)**.
