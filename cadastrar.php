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

// Obter dados do formulário
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];

// Preparar e executar a consulta SQL
$sql = "INSERT INTO produtos (nome, descricao, preco) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssd", $nome, $descricao, $preco);

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = "Produto cadastrado com sucesso!";
} else {
    $response['success'] = false;
    $response['message'] = "Erro ao cadastrar produto: " . $stmt->error;
}

// Fechar conexão
$stmt->close();
$conn->close();

// Retornar a resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
