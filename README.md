# 💰 Projeto Callazans

O **Callazans** é um sistema desenvolvido para auxiliar no **gerenciamento financeiro pessoal**, oferecendo uma interface onde o usuário pode adicionar informações de **salário** e **despesas**.  
A partir desses dados, são exibidos **dashboards interativos**, fornecendo uma visão clara e prática da situação financeira.

---

## 🚀 Tecnologias Utilizadas

- **Python** → execução de scripts `.sql` para criação de tabelas.  
- **MySQL** → banco de dados utilizado para armazenamento.  
- **Terraform** → provisionamento da infraestrutura do banco (usuário e database).  
- **POO** → implementação orientada a objetos.  
- **DAO + MVC** → organização do projeto com boas práticas de arquitetura.  

---

## 📂 Estrutura do Projeto

```bash
├───app                # Scripts Python responsáveis por rodar o .sql
├───conexao            # Conexão com o banco de dados
├───config_infra_bd    # Terraform (infraestrutura do banco, usuário e database)
├───controller         # Tratamento dos dados (set e get)
├───model              # Queries SQL para o MySQL
├───script_db          # Definição das tabelas
└───views              # Páginas do projeto (MVC)
```
## ⚙️ Funcionalidades

- Cadastro de **salário** e **despesas**  
- Exibição de **dashboards financeiros**  
- Estrutura organizada em **MVC** para fácil manutenção  
- Infraestrutura automatizada com **Terraform**  
- Conexão simples e escalável com o **MySQL**  

## 📌 Como usar

### Pré-requisitos

Antes de começar, é necessário ter instalado em sua máquina:

- **[XAMPP](https://www.apachefriends.org/pt_br/download.html)** → para habilitar a conexão com o MySQL  
- **[MySQL](https://dev.mysql.com/downloads/installer/)** → banco de dados  
- **[Terraform](https://developer.hashicorp.com/terraform/downloads)** → provisionamento da infraestrutura  
- **[Python](https://www.python.org/downloads/)** → linguagem para rodar os scripts  
  - Após instalar, execute:
    ```bash
    pip install mysql-connector-python
    ```
- **[Visual Studio Code](https://code.visualstudio.com/)** ou outra IDE de sua preferência  

---

### Passos para rodar o projeto

1. **Clonar o repositório**
   ```bash
   git clone https://github.com/rafaelvon1/Projeto_Calazzans.git
   cd Projeto_Calazzans```
2. **Subir PR**
   ```bash
   git add .
   git commit -m "minhas alterações"
   git push origin minha-branch```


   
  🔗 **[Demonstração do Projeto](https://projeto-calazzans.onrender.com)**  

⚠️ Atenção: esta é apenas uma **versão de demonstração**, podendo conter limitações em relação ao projeto final.

  

