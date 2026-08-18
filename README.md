# Sistema de Gerenciamento de Pratos

Um restaurante deseja desenvolver um sistema simples para organizar os pratos cadastrados por seus colaboradores. Atualmente, essas informações não possuem um controle centralizado, dificultando identificar quais pratos foram cadastrados e quem foi responsável por cada registro.

Sua equipe foi contratada para desenvolver uma primeira versão desse sistema utilizando **PHP, MySQL, HTML e CSS**, executando a aplicação localmente através do **XAMPP**.

## Desafio

Desenvolva um sistema que permita o cadastro de usuários e o gerenciamento de pratos do restaurante.

Cada prato deverá estar relacionado ao usuário responsável pelo seu cadastro. Dessa forma, ao cadastrar um novo prato, o sistema deverá armazenar não apenas suas informações, mas também identificar qual usuário realizou o cadastro.

O banco de dados deverá possuir pelo menos duas tabelas relacionadas:

- Uma para armazenar os usuários;
- Outra para armazenar os pratos.

O sistema deverá permitir:

- Cadastrar usuários;
- Cadastrar pratos;
- Visualizar os pratos existentes;
- Editar suas informações;
- Excluir registros;
- Identificar os pratos cadastrados por cada usuário.

## Requisitos do Sistema

### RF1 — Cadastrar Usuário

O sistema deve permitir cadastrar usuários informando:

- Nome;
- E-mail.

### RF2 — Cadastrar Prato

O sistema deve permitir que um usuário cadastre um prato informando:

- Nome;
- Descrição;
- Preço;
- Categoria.

### RF3 — Listar Pratos

O sistema deve apresentar todos os pratos cadastrados, informando também o usuário responsável pelo cadastro.

### RF4 — Editar Prato

O sistema deve permitir alterar as informações de um prato já cadastrado.

### RF5 — Excluir Prato

O sistema deve permitir excluir um prato já cadastrado.

### RF6 — Listar Pratos por Usuário

O sistema deve permitir visualizar os pratos cadastrados por um determinado usuário.

## Requisitos Não Funcionais

### RNF1 — Validação dos Campos

O sistema não deve permitir o cadastro de usuários ou pratos com campos obrigatórios vazios.

### RNF2 — Segurança dos Dados

As operações que recebem informações fornecidas pelo usuário deverão utilizar **Prepared Statements**.