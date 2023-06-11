<!doctype html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="/img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/estilos.css">

    <title>Inova Tech:: Reuperação de Senha</title>
</head>

<body>

    <div class="d-flex flex-column wrapper">
        <nav class="navbar navbar-expand-lg navbar-bg-dark bg-black border-bottom shadow-sm mb-3">
            <div class="container-fluid">
                <a class="navbar-brand text-warning" href="index.php">
                    <img src="IMG/logo.png" alt="logo" width="50" height="50" class="d-inline-center text-center"> Inova Tech
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                  <span class=" navbar-toggler-icon "></span>
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
                                <a href="cadastro.php" class="nav-link text-warning">Quero Me Cadastrar</a>
                            </li>
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
                <div class="row justify-content-center ">
                    <form class="col-sm-10 col-md-8 col-md-6 ">
                        <h1 class="text-decoration-underline">Recuperação de Senha</h1>

                        <div class="form-floating mb-3 text-black">
                            <input type="e-mail" id="txtEmail" class="form-control" placeholder=" " autofocus>
                            <label for="txtEmail">E-mail</label>

                        </div>
                        <button type="button" onclick="window.location.href='confirmrecupsenha.php'" class="btn btn-lg btn-dark text-bg-warning">Recuperar Senha</button>
                        <p classs=" mt-3 ">
                            Ainda não é cadastrado?
                            <a class="text" href="cadastro.php ">Clique aqui</a> para se cadastrar.
                        </p>
                    </form>

                </div>

            </div>
        </main>

        <footer class=" border-top text-muted bg-dark ">
            <div class="container ">
                <div class="row py-3 ">
                    <div class="col-12 col-md-4 text-center text-warning">
                        ©2023 -Inova Tech Ltda ME<br>Rua Santo André,584 - Uberaba-MG<br> CNPJ 99.999.999/0001-99
                    </div>
                    <div class="col-12 col-md-4 text-center ">
                        <a href="privacidade.php " class="text-decoration-underline text-warning">Política de Privacidade</a><br>
                        <a href="termos.php " class="text-decoration-underline text-warning ">Termos de Uso</a><br>
                        <a href="quemsomos.php " class="text-decoration-underline text-warning">Quem Somos</a><br>
                        <a href="cancelamento.php " class="text-decoration-underline text-warning ">Política de Cancelamento</a>
                        <br>
                    </div>
                    <div class="col-12 col-md-4 text-center">
                        <a href="contato.php " class="text-decoration-none text-warning">Contato pelo Site</a><br>
                        <a href="mailto:email@dominio.com " class="text-decoration-none text-warning">E-mail: email@dominio.com</a><br>
                        <a href="phone:28999999990 " class="text-decoration-none text-warning"> Telefone:(28) 99999-9990</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src=" node_modules/bootstrap/dist/js/bootstrap.bundle.min.js "></script>

</body>

</html>