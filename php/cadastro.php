<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $conexao = mysqli_connect("localhost", "root", "", "prestadores_de_servico");

        if (!$conexao) {
            die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
        }
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confirma_senha = $_POST['confirma_senha'];
        $tipo_usuario = $_POST['tipo_usuario'];

        if ($senha != $confirma_senha) {
            echo "<p>As senhas não coincidem. Por favor, tente novamente.</p>";
        } else {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $query = "INSERT INTO usuarios (nome, email, senha, tipo_usuario) VALUES ('$nome', '$email', '$senha_hash', $tipo_usuario)";
            $result = mysqli_query($conexao, $query);

            if ($result) {
                sleep(1);
                header('Location: ../index.html');
            } else {
                header("../modal/erro.html");
            }
        }
        mysqli_close($conexao);
    }
    ?>