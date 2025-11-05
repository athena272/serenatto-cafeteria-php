# ☕ Serenatto Cafeteria - Sistema de Cardápio Digital

Sistema web desenvolvido em PHP para gerenciamento e exibição de cardápio digital de uma cafeteria. O projeto permite visualizar produtos organizados por categorias (Cafés e Almoços) e oferece um painel administrativo completo para gerenciar produtos.

<img width="1557" height="853" alt="image" src="https://github.com/user-attachments/assets/4c0f3d73-c819-46b9-ba99-f3f1b9cca15c" />

<img width="1712" height="897" alt="image" src="https://github.com/user-attachments/assets/3175ad35-3a76-42c6-aad1-2fcf1bd12dda" />

<img width="1787" height="806" alt="image" src="https://github.com/user-attachments/assets/3cd282b3-e069-40c7-a0bc-fd7fd9744edc" />

## 📋 Índice

- [Características](#-características)
- [Tecnologias Utilizadas](#-tecnologias-utilizadas)
- [Arquitetura](#-arquitetura)
- [Pré-requisitos](#-pré-requisitos)
- [Instalação](#-instalação)
- [Configuração](#-configuração)
- [Estrutura do Projeto](#-estrutura-do-projeto)
- [Banco de Dados](#-banco-de-dados)
- [Funcionalidades](#-funcionalidades)
- [Uso](#-uso)

## ✨ Características

- 🎨 **Interface Moderna**: Design responsivo e intuitivo
- 📱 **Cardápio Digital**: Exibição de produtos organizados por categorias
- 🔐 **Painel Administrativo**: Gerenciamento completo de produtos (CRUD)
- 📄 **Geração de Relatórios**: Exportação de produtos em PDF
- 🏗️ **Arquitetura Limpa**: Implementação de padrões de design (Repository Pattern, DDD)
- 🔒 **Segurança**: Validação e sanitização de dados

## 🛠️ Tecnologias Utilizadas

### Backend
- **PHP 8.0+** - Linguagem de programação
- **MySQL** - Banco de dados relacional
- **PDO** - Extensão para acesso ao banco de dados
- **Composer** - Gerenciador de dependências

### Bibliotecas
- **vlucas/phpdotenv** (^5.6) - Gerenciamento de variáveis de ambiente
- **dompdf/dompdf** (^3.1) - Geração de PDFs

### Frontend
- **HTML5** - Estrutura
- **CSS3** - Estilização
- **JavaScript** - Interatividade
- **jQuery** - Biblioteca JavaScript
- **jQuery MaskMoney** - Máscara monetária para inputs

## 🏛️ Arquitetura

O projeto segue os princípios de **Domain-Driven Design (DDD)** e utiliza o padrão **Repository Pattern**:

```
src/
├── Database/           # Camada de infraestrutura - Conexão com banco
├── Domain/            # Camada de domínio
│   ├── Models/        # Entidades de negócio
│   └── Repository/    # Interfaces de repositório
└── Infrastructure/    # Camada de infraestrutura
    └── Repository/    # Implementações concretas dos repositórios
```

### Camadas

1. **Domain (Domínio)**: Contém as regras de negócio e entidades
   - `Product`: Modelo de domínio que representa um produto
   - `ProductRepositoryInterface`: Contrato para repositórios de produtos

2. **Infrastructure (Infraestrutura)**: Implementações técnicas
   - `ConnectionCreator`: Classe responsável por criar conexões PDO
   - `PdoProductRepository`: Implementação do repositório usando PDO

3. **Presentation (Apresentação)**: Arquivos PHP que fazem a interface com o usuário
   - `index.php`: Página pública do cardápio
   - `admin.php`: Painel administrativo
   - `create-product.php`, `edit-product.php`, `delete-product.php`: CRUD de produtos
   - `generate-report.php`: Geração de relatórios PDF

## 📦 Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- **PHP 8.0 ou superior**
- **MySQL 5.7 ou superior** (ou MariaDB equivalente)
- **Composer** ([Download](https://getcomposer.org/download/))
- **Servidor Web** (Apache/Nginx) ou **PHP Built-in Server**
- **Extensão PDO** habilitada no PHP

## 🚀 Instalação

1. **Clone o repositório**:
```bash
git clone https://github.com/seu-usuario/serenatto-cafeteria-php.git
cd serenatto-cafeteria-php
```

2. **Instale as dependências do Composer**:
```bash
composer install
```

3. **Configure o banco de dados** (veja seção [Configuração](#-configuração))

4. **Execute os scripts SQL** para criar a estrutura do banco:
   - Execute `src/Schemas/tables-schema.sql` para criar a tabela
   - Execute `src/Schemas/insert-schema.sql` para inserir dados iniciais (opcional)

## ⚙️ Configuração

### 1. Arquivo .env

Crie um arquivo `.env` na raiz do projeto com as seguintes variáveis:

```env
DB_HOST=localhost
DB_NAME=serenatto
DB_USER=root
DB_PASS=
```

**Nota**: Ajuste as credenciais conforme sua configuração do MySQL.

### 2. Banco de Dados

#### Criar o banco de dados:
```sql
CREATE DATABASE serenatto;
```

#### Criar a tabela:
Execute o arquivo `src/Schemas/tables-schema.sql` ou execute manualmente:

```sql
CREATE TABLE `serenatto`.`products`
(
    `id`          INT           NOT NULL AUTO_INCREMENT,
    `type`        VARCHAR(45)   NOT NULL,
    `name`        VARCHAR(45)   NOT NULL,
    `description` VARCHAR(90)   NOT NULL,
    `image`       VARCHAR(80)   NOT NULL,
    `price`       DECIMAL(5, 2) NOT NULL,
    PRIMARY KEY (`id`)
);
```

#### Inserir dados iniciais (opcional):
Execute o arquivo `src/Schemas/insert-schema.sql` para popular o banco com dados de exemplo.

### 3. Permissões de Diretório

Certifique-se de que o diretório `img/` tenha permissões de escrita para upload de imagens:

```bash
chmod 755 img/
```

## 📁 Estrutura do Projeto

```
serenatto-cafeteria-php/
│
├── src/
│   ├── Database/
│   │   └── ConnectionCreator.php      # Gerenciador de conexão PDO
│   │
│   ├── Domain/
│   │   ├── Models/
│   │   │   └── Product.php            # Modelo de domínio Product
│   │   └── Repository/
│   │       └── ProductRepositoryInterface.php  # Interface do repositório
│   │
│   ├── Infrastructure/
│   │   └── Repository/
│   │       └── PdoProductRepository.php        # Implementação PDO do repositório
│   │
│   └── Schemas/
│       ├── tables-schema.sql          # Script de criação da tabela
│       └── insert-schema.sql          # Script de inserção de dados
│
├── css/
│   ├── reset.css                      # Reset CSS
│   ├── index.css                      # Estilos da página pública
│   ├── admin.css                      # Estilos do painel admin
│   └── form.css                       # Estilos dos formulários
│
├── js/
│   └── index.js                       # Scripts JavaScript (máscara monetária)
│
├── img/                               # Diretório de imagens dos produtos
│
├── admin.php                          # Painel administrativo
├── index.php                          # Página pública do cardápio
├── create-product.php                 # Criação de produtos
├── edit-product.php                   # Edição de produtos
├── delete-product.php                 # Exclusão de produtos
├── generate-report.php                # Geração de relatório PDF
├── pdf-content.php                    # Template HTML do PDF
├── login.html                         # Página de login (estrutura)
│
├── composer.json                      # Dependências do projeto
├── composer.lock                      # Lock file do Composer
├── .env                               # Variáveis de ambiente (não versionado)
├── .gitignore                         # Arquivos ignorados pelo Git
└── README.md                          # Este arquivo
```

## 🗄️ Banco de Dados

### Tabela: `products`

| Campo        | Tipo         | Descrição                    |
|--------------|--------------|------------------------------|
| `id`         | INT          | Chave primária (auto-increment) |
| `type`       | VARCHAR(45)  | Tipo do produto (Coffee/Lunch) |
| `name`       | VARCHAR(45)  | Nome do produto              |
| `description`| VARCHAR(90)  | Descrição do produto         |
| `image`      | VARCHAR(80)  | Nome do arquivo de imagem    |
| `price`      | DECIMAL(5,2) | Preço do produto             |

### Tipos de Produto

- **Coffee**: Produtos da categoria café
- **Lunch**: Produtos da categoria almoço

## 🎯 Funcionalidades

### Página Pública (`index.php`)
- ✅ Exibição de produtos organizados por categoria
- ✅ Seção de Cafés (Coffee Options)
- ✅ Seção de Almoços (Lunch Options)
- ✅ Design responsivo e moderno

### Painel Administrativo (`admin.php`)
- ✅ Listagem de todos os produtos
- ✅ Visualização em tabela com informações completas
- ✅ Links para edição e exclusão
- ✅ Botão para adicionar novo produto
- ✅ Geração de relatório em PDF
- ✅ Mensagens de feedback (flash messages)

### CRUD de Produtos

#### Criar Produto (`create-product.php`)
- ✅ Formulário para cadastro de novos produtos
- ✅ Upload de imagem
- ✅ Seleção de tipo (Coffee/Lunch)
- ✅ Máscara monetária para preço
- ✅ Validação de campos obrigatórios

#### Editar Produto (`edit-product.php`)
- ✅ Formulário pré-preenchido com dados atuais
- ✅ Atualização de imagem (opcional)
- ✅ Validação de ID de produto
- ✅ Mensagens de sucesso/erro

#### Excluir Produto (`delete-product.php`)
- ✅ Exclusão via POST (segurança)
- ✅ Validação de ID
- ✅ Mensagens de feedback

### Relatório PDF (`generate-report.php`)
- ✅ Geração de relatório em PDF com todos os produtos
- ✅ Formatação profissional
- ✅ Layout em landscape (A4)
- ✅ Logo da empresa
- ✅ Data/hora de geração

## 📖 Uso

### Executar o Projeto

#### Opção 1: PHP Built-in Server
```bash
php -S localhost:8000
```
Acesse: `http://localhost:8000`

#### Opção 2: Servidor Web (Apache/Nginx)
Configure o servidor web para apontar para o diretório raiz do projeto.

### Acessar as Páginas

- **Cardápio Público**: `http://localhost:8000/index.php`
- **Painel Admin**: `http://localhost:8000/admin.php`
- **Criar Produto**: `http://localhost:8000/create-product.php`
- **Gerar Relatório**: Acesse via botão no painel admin ou `http://localhost:8000/generate-report.php`

### Gerenciar Produtos

1. **Criar Produto**:
   - Acesse o painel admin
   - Clique em "Add Product"
   - Preencha o formulário e envie uma imagem
   - Clique em "Create Product"

2. **Editar Produto**:
   - No painel admin, clique em "Edit" no produto desejado
   - Modifique os campos necessários
   - Clique em "Update Product"

3. **Excluir Produto**:
   - No painel admin, clique em "Delete" no produto desejado
   - Confirmação automática

4. **Gerar Relatório**:
   - No painel admin, clique em "Download Report"
   - O PDF será gerado e baixado automaticamente

## 🔒 Segurança

- ✅ Sanitização de inputs com `filter_input()` e `htmlspecialchars()`
- ✅ Prepared Statements (PDO) para prevenir SQL Injection
- ✅ Validação de métodos HTTP (POST para ações destrutivas)
- ✅ Validação de tipos de dados
- ✅ Proteção contra acesso direto a arquivos sensíveis

## 📝 Notas

- O arquivo `.env` não deve ser versionado (já está no `.gitignore`)
- Imagens são armazenadas no diretório `img/`
- O sistema utiliza sessões PHP para mensagens flash
- O login (`login.html`) está presente mas não implementado funcionalmente

## 👤 Autor

**athena272**  
Email: guilhermera272@gmail.com

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

---

Desenvolvido com ❤️ para a Serenatto Cafeteria
