## Context

O projeto tem três arquivos de documentação relevantes para agentes e desenvolvedores: `README.md`, `GEMINI.md` e `SKILL.md`. Os três estão desatualizados em relação ao estado atual do sistema — nenhum reflete a estrutura modular, e o `README.md` ainda é o boilerplate genérico do Laravel sem qualquer menção ao projeto. Esta mudança é puramente documental: nenhum código de produção é alterado.

## Goals / Non-Goals

**Goals:**
- `README.md` passa a ser a fonte de verdade pública sobre o projeto: o que é, como instalar, como desenvolver, e como a arquitetura está organizada.
- `GEMINI.md` reflete corretamente a estrutura modular (`app/Modules/`) e os padrões atuais de registro de componentes Livewire.
- `SKILL.md` passa a ter conteúdo real, descrevendo o contexto do projeto para agentes que ativam a skill `admin-panel`.

**Non-Goals:**
- Não criar documentação de API ou Swagger.
- Não traduzir qualquer arquivo — `README.md` em inglês (padrão open-source), `GEMINI.md` em português (padrão existente).
- Não alterar `AGENTS.md` ou `CLAUDE.md` (gerenciados pelo Laravel Boost).
- Não adicionar wikis ou páginas externas.

## Decisions

### Decision 1: README em inglês

O `README.md` é o ponto de entrada público do projeto (GitHub, etc.). Manter em inglês segue a convenção da comunidade Laravel e do open-source em geral.

### Decision 2: GEMINI.md mantém foco em instruções de agente

O `GEMINI.md` é lido por agentes de IA, não por desenvolvedores humanos. O conteúdo deve ser preciso, denso e orientado a comandos — sem prosa extra.

### Decision 3: SKILL.md descreve o contexto do projeto como skill de agente

O arquivo segue o schema YAML frontmatter existente. As instruções devem orientar o agente sobre quando ativar a skill e quais convenções específicas do projeto seguir além das regras globais do `AGENTS.md`.

## Risks / Trade-offs

- **[Risco] README ficar desatualizado novamente** → Mitigação: tasks.md inclui uma nota de manutenção; a estrutura modular facilita a atualização ao adicionar módulos.
- **[Trade-off] GEMINI.md duplica parcialmente AGENTS.md** → Aceito: GEMINI.md serve como resumo operacional rápido para o agente Gemini sem precisar processar o AGENTS.md completo.
