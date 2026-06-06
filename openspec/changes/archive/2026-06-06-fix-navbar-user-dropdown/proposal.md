## Why

O menu dropdown do usuário no Navbar exibe o nome do usuário logado mas não abre ao clicar, pois o JavaScript do Bootstrap 5 (`bootstrap.bundle.js`) não está sendo importado no entry point `resources/js/app.js`. Sem esse módulo, o atributo `data-bs-toggle="dropdown"` não tem efeito.

## What Changes

- Adicionar o import do Bootstrap JS no `resources/js/app.js` para habilitar componentes interativos (dropdown, collapse, etc.)
- O HTML do navbar (`navbar.blade.php`) já está estruturado corretamente com `data-bs-toggle="dropdown"` e `dropdown-menu`; nenhuma alteração de template é necessária

## Capabilities

### New Capabilities
- (nenhuma — esta mudança é puramente uma correção de bug, sem nova funcionalidade)

### Modified Capabilities
- `admin-layout`: A inicialização do JavaScript do layout é corrigida para incluir Bootstrap JS, habilitando todos os componentes Bootstrap interativos (dropdown, modal, tooltip, etc.)

## Impact

- **`resources/js/app.js`**: adicionar `import 'bootstrap';` antes do import do AdminLTE
- **Build**: será necessário re-executar `npm run build` ou `npm run dev`
- **Sem breaking changes**: a alteração é aditiva e não afeta outras funcionalidades
