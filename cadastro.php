<?php
session_start();

include('conexao.php');

// Verifique se o usuário já está logado
if (isset($_SESSION['user_nome'])) {
    // O usuário já está logado, redirecionar para a página de usuário
    header("Location: usuario.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'], $_POST['senha'], $_POST['confirmar_senha'])) {
        // Obter o email, senha e confirmar_senha do formulário
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confirmarSenha = $_POST['confirmar_senha'];

        if (empty($email) || empty($senha) || empty($confirmarSenha)) {
            $_SESSION['cadastro_error'] = "Por favor, preencha todos os campos.";
        } elseif ($senha !== $confirmarSenha) {
            $_SESSION['cadastro_error'] = "A senha e a confirmação de senha não correspondem.";
        } else {
            // Consulta SQL para verificar se o email já está cadastrado
            $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $_SESSION['cadastro_error'] = "O email já está cadastrado. Por favor, utilize um email diferente.";
            } else {
                // Insere o novo usuário no banco de dados
                $stmt = $mysqli->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $_POST['nome'], $_POST['telefone'], $email,password_hash($senha, PASSWORD_DEFAULT));
                $stmt->execute();

                // Login bem-sucedido
                $_SESSION['user_nome'] = $_POST['nome'];
                header("Location: usuario.php");
                exit();
            }
        }
    } else {
        $_SESSION['cadastro_error'] = "Por favor, preencha todos os campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/estilos.css">

    <title>Inova Tech:: Cadastro</title>
</head>

<body>

    <div class="d-flex flex-column wrapper">
        <nav class="navbar navbar-expand-lg navbar-bg-dark bg-black border-bottom shadow-sm mb-3">
            <div class="container-fluid">
                <a class="navbar-brand text-warning" href="index.php">
                    <img src="IMG/logo.png" alt="logo" width="50" height="50" class="d-inline-center text-center"> Inova Tech
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                    <span class="navbar-toggler-icon "></span>
                </button>
                <div class="collapse navbar-collapse ">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item ">
                            <a class="nav-link active text-warning" href="index.php ">Principal</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active text-warning" href="contato.php">Contato</a>
                        </li>
                    </ul>
                    <div class="align-self-end">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="login.php" class="nav-link text-warning">Entrar</a>
                            </li>
                            <li class="nav-item">
                                <a href="carrinho.php" class="nav-link text-warning">
                                    <i class="bi-cart" style="font-size: 24px;line-height: 24px;">
                                    </i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <main class="flex-fill">
            <div class="container text-warning">
                <div class="row justify-content-center">
                    <form class="col-sm-10 col-md-8 col-lg-6 " method="POST" action="">
                        <h1 class="text-decoration-underline">Cadastre-se</h1>

                        <?php if (isset($_SESSION['cadastro_error'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['cadastro_error']; ?>
                            </div>
                            <?php unset($_SESSION['cadastro_error']); ?>
                        <?php endif; ?>

                        <div class="form-floating mb-3 text-dark">
                            <input type="text" id="nome" class="form-control" placeholder=" " autofocus="" name="nome">
                            <label for="nome">Nome</label>
                        </div>

                        <div class="form-floating mb-3 text-dark">
                            <input type="tel" id="telefone" class="form-control" placeholder=" " name="telefone">
                            <label for="telefone">Telefone</label>
                        </div>

                        <div class="form-floating mb-3 text-dark">
                            <input type="email" id="email" class="form-control" placeholder=" " name="email">
                            <label for="email">E-mail</label>
                        </div>

                        <div class="form-floating mb-3 text-dark">
                            <input type="password" id="senha" class="form-control" placeholder=" " name="senha">
                            <label for="senha">Senha</label>
                        </div>

                        <div class="form-floating mb-3 text-dark">
                            <input type="password" id="confirmar_senha" class="form-control" placeholder=" " name="confirmar_senha">
                            <label for="confirmar_senha">Confirmar Senha</label>
                        </div>

                        <button type="submit" class="btn btn-lg btn-dark text-bg-warning">Cadastrar</button>

                        <p class="mt-3 ">
                            Já possui cadastro? <a class="text" href="login.php">Clique aqui</a> para fazer login.
                        </p>
                    </form>
                </div>
            </div>
        </main>
        <footer class="bg-dark text-white text-center">
            <div class="container py-3">
            <p class="mb-0">Desenvolvido por <a href="https://www.inovatech.com">Inova Tech</a></p>
            </div>
        </footer>
    </div>

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>