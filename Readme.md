# Desafio PHP

Criar banco de dados:

```sql
CREATE DATABASE ouvidoria;

USE ouvidoria;

CREATE TABLE ouvidoria.user (
id int NOT NULL AUTO_INCREMENT,
fullName varchar(255) NOT NULL,
email varchar(255) NOT NULL,
password varchar(255) NOT NULL,
birthdate date NOT NULL,
phone varchar(20) DEFAULT NULL,
whatsapp varchar(20) DEFAULT NULL,
state varchar(100) DEFAULT NULL,
city varchar(100) DEFAULT NULL,
PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE ouvidoria.ticket (
id int NOT NULL AUTO_INCREMENT,
user_id int NOT NULL,
description text NOT NULL,
type varchar(255) NOT NULL,
created_at datetime NOT NULL,
updated_at datetime DEFAULT NULL,
attachment longblob,
PRIMARY KEY (id),
KEY userId_idx (user_id),
CONSTRAINT userId FOREIGN KEY (user_id) REFERENCES user (id)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;
```

Executar o servidor php.

---

**Desafio**: A prefeitura deseja implementar uma plataforma de ouvidoria online que permitirá aos cidadãos registrar reclamações, sugestões ou denúncias, facilitando a comunicação entre a população e a administração municipal. Este projeto visa testar suas habilidades de programação full-stack utilizando tecnologias específicas.

Tecnologias Requeridas

- Frontend: Bootstrap, jQuery
- Backend: PHP puro
- Database: MySQL
- Controle de Versão: GIT

Requerimentos do Projeto

# 1. Página Inicial

- [x]  Informações gerais sobre como usar a ouvidoria.
- [x]  Opção para login/cadastro.

# 2. Cadastro e Login

- Formulário de cadastro com validação:
    - [x]  Campos: nome completo, data de nascimento, e-mail, telefone, whatsapp, senha e confirmação da senha, cidade e estado.
    - [x]  Todos os campos são obrigatórios.
    - [x]  A pessoa deve ter mais de 18 anos.
    - [x]  Verificação de e-mail válido.
    - [x]  Máscaras para números de telefone e WhatsApp.
    - [x]  O estado seleciona as cidades disponíveis via carregamento dinâmico.
    - [x]  Salvar dados no banco de dados com proteção contra SQL Injection.
- [ ]  Envio de código de validação para o e-mail cadastrado.
- [x]  Login com criação de sessão em PHP.

# 3. Abertura de Ouvidoria

- [x]  Somente após login.
- [x]  Formulário para registro de nova ouvidoria:
    - [x]  Campos: descrição do caso, tipo de serviço afetado, anexos (1 ou mais).
    - [x]  Todos os campos são obrigatórios.
    - [x]  Anexos salvos em base64 no banco de dados.
- [x]  Validação do formulário com jQuery antes da submissão.

# 4. Listagem de Ouvidorias

- [x]  Visualização de ouvidorias abertas pelo usuário logado.

# 5. Segurança

- [x]  Proteção contra principais vulnerabilidades web (SQL Injection, XSS, etc.).
- [x]  Senhas armazenadas de forma segura.

# 6. Documentação e Código

- [x]  Código fonte bem organizado e comentado.
- [x]  Documentação clara do projeto.

**Entrega**

- O projeto completo deve ser postado no GitHub, incluindo o arquivo SQL para a criação do banco de dados.
- **Prazo de entrega: 30 dias a partir da data de hoje. `[26/04/2024]`**

# Notas Importantes

- É imperativo que o desenvolvimento seja individual, sem ajuda direta de outras pessoas, utilizando apenas recursos e conhecimento obtidos por pesquisa independente.
- Qualquer criatividade adicional que adicione valor ao projeto sem desviar totalmente do objetivo será valorizada.
- A comunicação entre frontend (jQuery) e backend (PHP) deve ser realizada via AJAX.

# **Critérios de Avaliação**

- Funcionalidade: o sistema funciona conforme o solicitado.
- Segurança: implementação de práticas de segurança adequadas.
- Organização e clareza do código.
- Cumprimento das orientações e prazos especificados.
- Qualidade da interface de usuário.
- Documentação: clareza e completude.

*Este desafio é uma oportunidade para demonstrar habilidades de programação, capacidade de aprendizado autodirigido, criatividade e precisão na implementação de requisitos complexos. Tudo de melhor em seu desenvolvimento!*