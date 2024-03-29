<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexao = mysqli_connect("localhost", "root", "", "prestadores_de_servico");
        if (!$conexao) {
            die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
        }

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $query = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = mysqli_query($conexao, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($senha, $row['senha'])) {
                session_start();
                $_SESSION['id_usuario'] = $row['id'];
                header("Location: perfil_usuario.php"); 
            } else {
                echo "<p>Senha incorreta. Por favor, tente novamente.</p><a href='../index.html'>Voltar</a>";
            }
        } else {
            echo "<p>Email não encontrado. Por favor, verifique seu email ou realize o cadastro.</p><a href='../index.html'>Voltar</a>";
        }
        mysqli_close($conexao);
    }
    ?>