## ADDED Requirements

### Requirement: Navbar exibe nome do usuário e menu de usuário
O sistema SHALL exibir na navbar o nome do usuário logado com dropdown de acesso ao perfil e logout.

#### Scenario: Navbar com usuário logado
- **WHEN** usuário autenticado visualiza qualquer página do painel
- **THEN** navbar exibe nome do usuário e ícone de dropdown com links "Meu Perfil" e "Sair"

### Requirement: Sidebar exibe itens de menu configurados
O sistema SHALL renderizar os itens da sidebar com base no arquivo `config/menu.php`, filtrando por papel do usuário.

#### Scenario: Itens sem restrição de papel
- **WHEN** qualquer usuário autenticado visualiza a sidebar
- **THEN** itens sem `role` definido no config são exibidos para todos

#### Scenario: Itens restritos por papel
- **WHEN** item de menu tem `role => 'admin'` no config
- **THEN** item só aparece para usuários com papel Admin

### Requirement: Item ativo da sidebar é destacado visualmente
O sistema SHALL marcar com classe `active` o item de menu correspondente à rota atual.

#### Scenario: Usuário na página de usuários
- **WHEN** usuário está na rota `/users`
- **THEN** item "Usuários" na sidebar possui a classe CSS `active`

### Requirement: Sidebar suporta subitens (dropdown de 2 níveis)
O sistema SHALL renderizar subitens como dropdown expansível na sidebar quando configurado.

#### Scenario: Item com subitens
- **WHEN** item de menu tem `children` definido no config
- **THEN** sidebar renderiza o item como dropdown com os filhos listados abaixo

### Requirement: Breadcrumbs refletem a página atual
O sistema SHALL exibir breadcrumbs no cabeçalho de conteúdo indicando a hierarquia de navegação.

#### Scenario: Página de edição de usuário
- **WHEN** admin acessa a edição de um usuário
- **THEN** breadcrumb exibe: Início > Usuários > Editar
