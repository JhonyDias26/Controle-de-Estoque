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

// Obter ID do produto a ser removido
$id = intval($_GET['id']);

// Preparar e executar a consulta SQL
$sql = "DELETE FROM produtos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header('Location: index.php?msg=Produto removido com sucesso!');
} else {
    header('Location: index.php?msg=Erro ao remover produto: ' . $stmt->error);
}

// Fechar conexão
$stmt->close();
$conn->close();
?>
