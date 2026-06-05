## ADDED Requirements

### Requirement: Dashboard exibe cards de métricas
O sistema SHALL exibir no dashboard ao menos 4 cards informativos com contagens ou métricas do sistema.

#### Scenario: Dashboard do admin
- **WHEN** usuário Admin acessa `/dashboard`
- **THEN** página exibe cards com: Total de Usuários, Usuários Ativos, Usuários Admin, Usuários Inativos

#### Scenario: Dashboard de usuário comum
- **WHEN** usuário com papel User acessa `/dashboard`
- **THEN** página exibe o dashboard com mensagem de boas-vindas e cards aplicáveis ao seu contexto

### Requirement: Dashboard é a página inicial após login
O sistema SHALL redirecionar para `/dashboard` após autenticação bem-sucedida.

#### Scenario: Redirecionamento pós-login
- **WHEN** usuário faz login com sucesso
- **THEN** sistema redireciona para `/dashboard`

### Requirement: Widgets do dashboard são componentes Livewire independentes
O sistema SHALL implementar cada card de métrica como um componente Livewire embedded separado.

#### Scenario: Widget carregado individualmente
- **WHEN** página do dashboard é renderizada
- **THEN** cada card de métrica é um componente Livewire com dados carregados de forma independente
