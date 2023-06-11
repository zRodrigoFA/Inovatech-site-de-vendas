<?php
session_start(); // Iniciar a sessão

include('conexao.php');

if (isset($_SESSION['user_nome'])) {
    // O usuário já está logado, redirecionar para a página de usuário
    header("Location: usuario.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/estilos.css">

    <title>Loja de Jogos :: Página Principal</title>
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
                                
                                <a href="login.php" class="nav-link text-warning">
                                    <i class="bi-cart" style="font-size: 24px;line-height: 24px;">
                                </i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container">
            <div id="carouselMain" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="3000">
                        <img src="img/banner3.jpeg" class="d-none d-md-block w-100" alt="">

                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="img/banner4.jpeg" class="d-none d-md-block w-100" alt="">

                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="img/banner2.jpeg" class="d-none d-md-block w-100" alt="">

                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="img/banner4.jpeg" class="d-none d-md-block w-100" alt="">

                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="img/banner6.jpeg" class="d-none d-md-block w-100" alt="">

                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselMain" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselMain" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Próximo</span>
                </button>
            </div>
            <hr class="mt-3">
        </div>

        <main class="flex-fill">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <form class="justify-content-center text-dark mb-3 mb-md-0" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Digite aqui o que procura" name="search">
                                <button class="btn btn-lg btn-dark text-bg-warning">Buscar </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="d-flex flex-row-reverse justify-content-center justify-content-md-start">
                            <form class="d-inline-block" method="GET">
                                <select class="form-select form-select-sm" name="sort">
                                    <option value="nome">Ordenar pelo nome</option>
                                    <option value="preco-asc">Ordenar pelo menor preço</option>
                                    <option value="preco-desc">Ordenar pelo maior preço</option>
                                </select>
                                <button type="submit" class="btn btn-dark text-bg-warning">Ordenar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <hr m-3>
                <?php
// Exiba todos os produtos do banco de dados
if(isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM produtos WHERE nome LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM produtos";
}

if(isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    switch ($sort) {
        case 'nome':
            $sql .= " ORDER BY nome ASC";
            break;
        case 'preco-asc':
            $sql .= " ORDER BY preco ASC";
            break;
        case 'preco-desc':
            $sql .= " ORDER BY preco DESC";
            break;
    }
}

$result = $mysqli->query($sql);

echo "<div class='row g-3'>"; // Inicia a div de linha aqui

while ($row = $result->fetch_assoc()) {
    $nome = $row["nome"];
    $tipo = $row["tipo"];
    $tempo = $row["tempo"];
    $descricao = $row["descricao"];
    $preco = $row["preco"];
    $imagem = base64_encode($row["imagem"]);

    echo "<div class='col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2'>";
    echo "<div class='card text-center text-warning bg-black'>";
    echo "<a href='#' class='position-absolute end-0 p-2 text-danger'>";
    echo "<i class='bi-suit-heart' style='font-size: 24px; line-height: 24px;'></i>";
    echo "</a>";
    echo "<img src='data:image/jpeg;base64,$imagem' class='card-img-top'>";
    echo "<div class='card-body'>";
    echo "<ul class='list-group list-group-flush'>";
    echo "<li class='list-group-item text-warning bg-black'>$nome</li>";
    echo "<li class='list-group-item text-warning bg-black'>$tipo</li>";
    echo "<li class='list-group-item text-warning bg-black'>$tempo</li>";
    echo "<li class='list-group-item text-warning bg-black'>Preço: $preco</li>";
    echo "</ul>";
    echo "<div class='card-footer'>";
    echo "<a href='login.php' class='btn btn-lg btn-dark mt-2 text-bg-warning'>Adicionar ao carrinho</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}

echo "</div>"; // Encerra a div de linha aqui

$mysqli->close();
?>
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