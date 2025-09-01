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
