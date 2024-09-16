<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Produto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #0056b3;
        }
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            text-align: center;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .button-primary {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #28a745;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .button-primary:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Cadastrar Novo Produto</h1>
    <form id="form-cadastro">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"></textarea><br><br>

        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" required><br><br>

        <input type="submit" value="Cadastrar">
    </form>
    <a href="index.php" class="button">Voltar à Página Inicial</a>

    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modal-message"></p>
            <a id="modal-button" href="" class="button-primary">Voltar à Página Inicial</a>
        </div>
    </div>

    <script>
        // Funcionalidade do modal
        var modal = document.getElementById("modal");
        var span = document.getElementsByClassName("close")[0];
        var modalButton = document.getElementById("modal-button");

        // Evento para exibir o modal
        function showModal(message, redirectUrl) {
            document.getElementById("modal-message").innerText = message;
            modalButton.href = redirectUrl;
            modal.style.display = "block";
        }

        // Evento de clique no "x" para fechar o modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Clique fora do modal fecha o modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Manipulação do envio do formulário
        document.getElementById('form-cadastro').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            fetch('cadastrar.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showModal(data.message, 'index.php');
                    // Limpar o formulário após o sucesso
                    this.reset();
                } else {
                    showModal(data.message, 'index.php');
                }
            })
            .catch(error => {
                showModal('Erro na comunicação com o servidor.', 'index.php');
            });
        });
    </script>
</body>
</html>
