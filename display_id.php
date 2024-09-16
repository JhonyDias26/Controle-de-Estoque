<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loja";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Adicionar coluna display_id (apenas uma vez)
$sql = "ALTER TABLE produtos ADD COLUMN display_id INT;";
$conn->query($sql);

// Atualizar display_id com IDs contínuos
$sql = "SET @count = 0;";
$conn->query($sql);
$sql = "UPDATE produtos SET display_id = @count := (@count + 1);";
$conn->query($sql);

// Fechar conexão
$conn->close();

echo "IDs de exibição atualizados com sucesso!";
?>
