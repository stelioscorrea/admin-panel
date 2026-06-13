## Why

Os arquivos de documentação do projeto (`README.md`, `GEMINI.md`, `SKILL.md`) estão desatualizados ou vazios: o `README.md` ainda é o boilerplate padrão do Laravel (sem nenhuma informação do projeto real), o `GEMINI.md` não reflete a arquitetura modular introduzida, e o `SKILL.md` está completamente vazio/placeholder. Com a maturidade atual do projeto — dashboard administrativo funcional, gerenciamento de usuários, autenticação, perfil e estrutura modular — é o momento certo de ter documentação que reflita o estado real da aplicação.

## What Changes

- **`README.md`**: substituído integralmente pelo boilerplate genérico do Laravel por documentação específica do projeto: visão geral, stack, estrutura de módulos, comandos essenciais, convenções e instruções de setup.
- **`GEMINI.md`**: atualizado para refletir a arquitetura modular (`app/Modules/`), o padrão de registro de Livewire via `AppServiceProvider`, e a separação de rotas por módulo.
- **`SKILL.md`**: preenchido com uma descrição real da skill `admin-panel`, incluindo quando ativá-la e as instruções de contexto para agentes.

## Capabilities

### New Capabilities

- `project-readme`: Documentação principal do projeto com visão geral, stack, estrutura, setup e convenções — substitui o README genérico do Laravel.

### Modified Capabilities

*(Nenhuma — as alterações em GEMINI.md e SKILL.md são de implementação/conteúdo, não de requisitos funcionais do sistema.)*

## Impact

- **`README.md`**: arquivo totalmente reescrito — sem impacto em código.
- **`GEMINI.md`**: atualização de conteúdo — sem impacto em código.
- **`SKILL.md`**: preenchimento de conteúdo — sem impacto em código.
- Nenhuma mudança em rotas, modelos, componentes Livewire, testes ou banco de dados.
