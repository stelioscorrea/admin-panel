## Context

O Navbar do admin panel exibe corretamente o nome do usuário autenticado, mas ao clicar no item o dropdown não abre. O arquivo `resources/js/app.js` importa somente `adminlte/dist/js/adminlte.js`, omitindo o pacote JavaScript do Bootstrap 5. Como resultado, o atributo `data-bs-toggle="dropdown"` declarado no `navbar.blade.php` não possui o módulo Bootstrap para inicializar e controlar o comportamento do dropdown.

O Bootstrap 5 já está listado como dependência no `package.json` (`"bootstrap": "^5.3.8"`), portanto nenhuma instalação adicional é necessária.

## Goals / Non-Goals

**Goals:**
- Corrigir o dropdown do usuário no Navbar adicionando o import do Bootstrap JS
- Garantir que todos os componentes Bootstrap interativos (dropdown, modal, tooltip, collapse) funcionem corretamente no layout

**Non-Goals:**
- Alterar o template HTML do Navbar
- Modificar estilos CSS do dropdown
- Adicionar novos itens ao menu do usuário

## Decisions

### Importar `bootstrap` antes do `adminlte.js`

**Decisão**: Adicionar `import 'bootstrap';` no topo de `resources/js/app.js`, antes do import do AdminLTE.

**Rationale**: O AdminLTE 4 depende do Bootstrap 5, e a ordem de importação garante que o Bootstrap inicialize primeiro. O pacote `bootstrap` já está instalado no projeto, então a correção é de uma linha. Alternativamente, poderia-se usar `import 'bootstrap/dist/js/bootstrap.bundle';` para importação explícita do bundle com Popper.js — preferível para garantir que Popper (necessário para dropdowns e tooltips) seja incluído.

**Alternativa considerada**: Adicionar o script via CDN no layout Blade — descartado pois o projeto já usa Vite para bundling e adicionar CDN criaria inconsistência.

## Risks / Trade-offs

- **Tamanho do bundle aumenta levemente** → Aceitável; Bootstrap JS já era uma dependência implícita do AdminLTE e estava ausente apenas por omissão.
- **Ordem de importação incorreta pode gerar conflitos** → Mitigação: importar Bootstrap antes do AdminLTE, seguindo a convenção de dependência.
