## MODIFIED Requirements

### Requirement: Layout inicializa corretamente os componentes JavaScript do Bootstrap
O sistema SHALL importar o pacote JavaScript do Bootstrap 5 (incluindo Popper.js) no entry point `resources/js/app.js` para que todos os componentes Bootstrap interativos funcionem corretamente.

#### Scenario: Dropdown do usuário abre ao clicar
- **WHEN** o usuário autenticado clica no item do Navbar com seu nome
- **THEN** o sistema SHALL exibir o menu dropdown com as opções "Meu Perfil" e "Sair"

#### Scenario: Dropdown fecha ao clicar fora
- **WHEN** o dropdown está aberto e o usuário clica fora dele
- **THEN** o sistema SHALL fechar o dropdown automaticamente

#### Scenario: Link de perfil navega para a página de perfil
- **WHEN** o usuário clica em "Meu Perfil" no dropdown
- **THEN** o sistema SHALL navegar para a rota `profile`

#### Scenario: Botão Sair realiza logout
- **WHEN** o usuário clica em "Sair" no dropdown
- **THEN** o sistema SHALL submeter o formulário de logout e encerrar a sessão
