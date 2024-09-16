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

// Recuperar produtos do banco de dados
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

// Calcular o total dos preços dos produtos
$total = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $total += $row['preco'];
    }
}

// Fechar conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial - Lista de Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
            color: #343a40;
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            text-align: center;
        }
        .button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #007bff;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #e9ecef;
        }
        .action-buttons a {
            margin-right: 10px;
        }
        .button-edit {
            background-color: #28a745;
        }
        .button-edit:hover {
            background-color: #218838;
        }
        .button-remove {
            background-color: #dc3545;
        }
        .button-remove:hover {
            background-color: #c82333;
        }
        p {
            text-align: center;
            font-size: 18px;
            color: #28a745;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <h1>Lista de Produtos</h1>
    <a href="formulario.php" class="button">Cadastrar Novo Produto</a>
    
    <?php if (isset($_GET['msg'])): ?>
        <p><?php echo htmlspecialchars($_GET['msg']); ?></p>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Data de Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Voltar o ponteiro do resultado para o início
                $result->data_seek(0);
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nome']); ?></td>
                        <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                        <td><?php echo htmlspecialchars(number_format($row['preco'], 2, ',', '.')); ?></td>
                        <td><?php echo htmlspecialchars($row['data_cadastro']); ?></td>
                        <td class="action-buttons">
                            <a href="editar.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="button button-edit">Editar</a>
                            <a href="remover.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="button button-remove" onclick="return confirm('Tem certeza que deseja remover este produto?');">Remover</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="total">
            Total dos Produtos: R$ <?php echo number_format($total, 2, ',', '.'); ?>
        </div>
    <?php else: ?>
        <p>Nenhum produto cadastrado.</p>
    <?php endif; ?>
</body>
</html>
