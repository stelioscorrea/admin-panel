## ADDED Requirements

### Requirement: Componente de tabela com busca em tempo real
O sistema SHALL fornecer um componente Livewire base de tabela com campo de busca que filtra resultados em tempo real.

#### Scenario: Busca ativa
- **WHEN** usuário digita no campo de busca da tabela
- **THEN** Livewire atualiza a listagem sem recarregar a página, exibindo apenas os registros correspondentes

### Requirement: Componente de tabela com paginação
O sistema SHALL fornecer paginação configurável no componente de tabela base.

#### Scenario: Paginação com 15 itens por página (padrão)
- **WHEN** tabela possui mais de 15 registros
- **THEN** sistema exibe controles de paginação e divide os registros em páginas de 15

### Requirement: Componente de tabela com ordenação por coluna
O sistema SHALL permitir ordenar a tabela clicando no cabeçalho de colunas ordenáveis.

#### Scenario: Ordenação ascendente
- **WHEN** usuário clica em um cabeçalho de coluna ordenável
- **THEN** tabela reordena os dados de forma ascendente por aquela coluna

#### Scenario: Ordenação descendente
- **WHEN** usuário clica novamente no mesmo cabeçalho já selecionado
- **THEN** tabela inverte a ordem para descendente

### Requirement: Modal de confirmação reutilizável
O sistema SHALL fornecer um componente de modal de confirmação genérico para ações destrutivas.

#### Scenario: Confirmação de ação
- **WHEN** usuário clica em "Inativar" e o modal de confirmação é exibido
- **THEN** modal mostra título e mensagem configuráveis com botões "Confirmar" e "Cancelar"

#### Scenario: Cancelamento do modal
- **WHEN** usuário clica em "Cancelar" no modal de confirmação
- **THEN** modal fecha sem executar a ação

### Requirement: Toast notifications para feedback de ações
O sistema SHALL exibir notificações toast temporárias para confirmar ou alertar sobre ações do usuário.

#### Scenario: Toast de sucesso
- **WHEN** uma ação Livewire despacha o evento `notify` com tipo `success`
- **THEN** toast verde aparece no canto superior direito e desaparece após 4 segundos

#### Scenario: Toast de erro
- **WHEN** uma ação Livewire despacha o evento `notify` com tipo `error`
- **THEN** toast vermelho aparece no canto superior direito

### Requirement: Inputs de formulário padronizados como componentes Blade
O sistema SHALL fornecer componentes Blade para inputs de texto, select e textarea com suporte a label, placeholder e exibição de erros de validação.

#### Scenario: Input com erro de validação
- **WHEN** formulário é submetido com campo inválido
- **THEN** input exibe borda vermelha e mensagem de erro abaixo do campo
