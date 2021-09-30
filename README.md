# Sistema de Agenda Pessoal

# Sobre o Projeto

Projeto usando php que simula uma agenda pessoal, nela voce podera adicionar uma nota, ver as notas existentes, tornar ela prioridade ou nao, alterar a nota ou apaga-la.

# Tecnologias usadas

- PHP 
- Mysql 
- Bootstrap
- HTML e CSS

# Pré-Requisitos
## As versões mais recentes de:
- PHP (versao 7.4.3 ou superior)
- Mysql (versao mais recente)

# Como Rodar o Projeto
```bash
# clonar repositório
git clone https://github.com/ArtDevRodrigues/CRUD-PHPMysql.git

# executar o projeto
php -S localhost:8080
```
## Observação (Antes de execultar)

- Rode o codigo sql, presente no repositório(arquivo: bdagenda.sql), no Mysql workbench para criar o banco de dados
- acesse o arquivo connection.php e altere para que ele receba o seu usuario e senha do mysql se baseando no codigo:
```
$myUserSQL = "seuUsuarioDoMysql";
$myPassSQL = "suaSenhaDoMysql";
$dataBaseUsed = "NomeDoBancoDeDados(use o 'agenda')";
```


## Acessando

Acesse o navegador com o seguinte link para ver o sistema executando: http://localhost:8080/

## Contatos do Autor

- Email: artdevrodrigues@gmail.com
- Linkdin: https://www.linkedin.com/in/arthur-h-rodrigues-2baab6208/
