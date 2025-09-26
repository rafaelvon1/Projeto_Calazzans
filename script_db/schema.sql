CREATE TABLE IF NOT EXISTS tabela_usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(250) NOT NULL
);

CREATE TABLE IF NOT EXISTS tabela_saldo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    descricao_saldo VARCHAR(100) NOT NULL,
    tipo_saldo VARCHAR(15) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    data_saldo VARCHAR(10) NOT NULL,
    frequencia VARCHAR(15) NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES tabela_usuarios(id_usuario)
);

CREATE TABLE IF NOT EXISTS tabela_despesa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    descricao_despesa VARCHAR(100) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    status_despesa VARCHAR(15) NOT NULL,
    frequencia VARCHAR(15) NOT NULL,
    forma_pagamento VARCHAR(25),
    parcelas INT NOT NULL,
    meta_gasto DECIMAL(10,2) NOT NULL,
    data_despesa DATE NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES tabela_usuarios(id_usuario)
);
