import mysql.connector

# Configuração da conexão
config = {
    "host": "127.0.0.1",
    "user": "root",
    "password": "",
    "database": "meubanco"
}

# Lê e executa o arquivo SQL
def run_sql_script(file_path):
    with open(file_path, "r", encoding="utf-8") as f:
        sql_commands = f.read()

    conn = mysql.connector.connect(**config)
    cursor = conn.cursor()

    for command in sql_commands.split(";"):
        cmd = command.strip()
        if cmd:
            cursor.execute(cmd)

    conn.commit()
    cursor.close()
    conn.close()
    print(f"✅ Script {file_path} executado com sucesso!")

if __name__ == "__main__":
    run_sql_script("script_db/schema.sql")
