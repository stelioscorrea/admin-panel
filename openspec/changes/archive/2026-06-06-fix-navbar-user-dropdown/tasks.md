## 1. Correção do Entry Point JavaScript

- [x] 1.1 Adicionar `import 'bootstrap/dist/js/bootstrap.bundle';` em `resources/js/app.js` antes do import do AdminLTE
- [x] 1.2 Verificar que o dropdown do usuário no Navbar abre corretamente ao clicar (com `npm run dev` ou `npm run build`)

## 2. Testes

- [x] 2.1 Criar teste de feature que verifica que o Navbar renderiza o nome do usuário autenticado e o link para a rota `profile`
- [x] 2.2 Criar teste de feature que verifica que o botão "Sair" realiza o logout (POST para a rota `logout`)
- [x] 2.3 Executar a suite de testes completa (`php artisan test --compact`) e confirmar que todos passam

## 3. Commit

- [x] 3.1 Formatar código PHP modificado com `vendor/bin/pint --dirty --format agent`
- [x] 3.2 Gerar commit com mensagem no formato Conventional Commits: `fix: import bootstrap js to enable navbar user dropdown`
