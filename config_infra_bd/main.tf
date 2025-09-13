terraform {
  required_providers {
    mysql = {
      source  = "petoju/mysql"
      version = "3.0.50"
    }
  }
}

provider "mysql" {
  endpoint = "127.0.0.1:3306"
  username = "root"
  password = ""
}

# Cria o banco
resource "mysql_database" "meubanco" {
  name = "banco_calazzans"
}

# Cria o usuário
resource "mysql_user" "app_user" {
  user               = "app"
  host               = "%"
  plaintext_password = "app_pass"
}


