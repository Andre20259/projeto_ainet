# projeto_ainet

## Clonar o repositório:

> Dentro da pasta www do laragon

```bash
git clone  https://github.com/Andre20259/projeto-ainet.git
```

Para o repositório ficar mais leve, e por segurança, os ficheiros .env e a base de dados não estão incluidas

**Após clonar o repositório, substituir o ficheiro .env e copiar a pasta database pela fornecida pelo professor.**

```bash
composer install
php artisan migrate:fresh
php artisan db:seed
npm install & npm run build
```

> Só é necessário fazer isto uma vez após clonar o repositório. Como o .env e a database estão no git ignore não haveram conlfitos para colocar no git hub


## Como fazer push para o github:

**Criar uma branch do tipo: dev_'nome' e fazer push para o github nessa dev para facilitar a junção do código.**

> Abrir um terminal na pasta do projeto (projeto_ainet)

```bash
git commit -a -m "mensagem do commit"
git push origin dev_'nome'
```

**Ou usar gitkraken / github desktop / vscode para fazer o commit e push**
