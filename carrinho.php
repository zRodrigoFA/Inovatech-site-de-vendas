<?php
// Inicia a sessão
session_start();

include('conexao.php');
require_once('./phpqrcode/qrlib.php');

// Verifica se o usuário não está logado
if (!isset($_SESSION['user_nome'])) {
    // Redireciona para a página de login
    header('Location: login.php');
    exit; // Encerra o script atual
}
if (!isset($_SESSION['quantidade_carrinho'])) {
    $_SESSION['quantidade_carrinho'] = 0; // Define o valor inicial como 0 ou outro valor adequado
}

$quantidadeTotal = 0;
if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
    foreach ($_SESSION['carrinho'] as $produto) {
        $quantidadeTotal += $produto['quantidade'];
    }
}

// Obtém os dados do produto do formulário enviado via POST
if (isset($_POST['quantidade']) && isset($_POST['produto_id']) && isset($_POST['produto_descricao']) && isset($_POST['produto_imagem']) && isset($_POST['produto_nome']) && isset($_POST['produto_preco'])) {
    $produto_id = $_POST['produto_id'];
    $produto_descricao = $_POST['produto_descricao'];
    $produto_imagem = $_POST['produto_imagem'];
    $produto_nome = $_POST['produto_nome'];
    $produto_preco = $_POST['produto_preco'];
    $quantidade = $_POST['quantidade'];

    // Armazena os dados do produto no carrinho
    $_SESSION['carrinho'][] = [
        'id' => $produto_id,
        'descricao' => $produto_descricao,
        'imagem' => $produto_imagem,
        'nome' => $produto_nome,
        'preco' => $produto_preco,
        'quantidade' => $quantidade
    ];

    // Redireciona para a página do carrinho
    header('Location: carrinho.php?finalizado=true');
    exit;
}

use Itau\QrcodePix\Payload;
use Itau\QrcodePix\QrCodePix;

$chavePix = 'Sóteste'; //Pix
$valor = calcularTotalCarrinho($_SESSION['carrinho']); 
$descricao = 'Pagamento do carrinho de compras'; 

$dadosPix = [
    'chave' => $chavePix,
    'valor' => $valor,
    'descricao' => $descricao
];

// Formata o conteúdo do QR code
$conteudoQR = 'chave=' . urlencode($dadosPix['chave']) . '&valor=' . urlencode($dadosPix['valor']) . '&descricao=' . urlencode($dadosPix['descricao']);

// Define o nome do arquivo onde o QR code será salvo
$nomeArquivoQR = 'qrcode.png';

// Gera o QR code
QRcode::png($conteudoQR, $nomeArquivoQR, QR_ECLEVEL_L, 10, 5, false, 0xFFFFFF, 0x000000);

?>

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
    <link rel="manifest" href="img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/estilos.css">

    <title>Inova Tech:: Carrinho de Compras</title>
</head>

<body>

    <div class="d-flex flex-column wrapper">
        <nav class="navbar navbar-expand-lg navbar-bg-dark bg-black border-bottom shadow-sm mb-3">
            <div class="container-fluid">
                <a class="navbar-brand text-warning" href="./index.php">
                    <img src="IMG/logo.png" alt="logo" width="50" height="50" class="d-inline-center text-center"> Inova Tech
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                  <span class=" navbar-toggler-icon "></span>
                </button>
                <div class="collapse navbar-collapse ">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item ">
                            <a class="nav-link active text-warning" href="./index.php ">Principal</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active text-warning" href="./contato.php">Contato</a>
                        </li>
                    </ul>
                    <div class="align-self-end">
                        <ul class="navbar-nav">
                        <li class="nav-item">
                                <a href="cadastro.php" class="nav-link text-warning"><?php echo "Olá, "; echo $_SESSION['user_nome']; ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="logout.php" class="nav-link text-warning">Sair</a>
                            </li>
                            <li class="nav-item">
                            <a href="carrinho.php" class="nav-link text-warning">
                                <span class="badge rounded-pill bg-light text-danger position-absolute ms-4 mt-0" title=" produto(s) no carrinho">
                                    <small><?php echo $quantidadeTotal; ?></small>
                                </span>
                                <i class="bi-cart" style="font-size: 24px;line-height: 24px;"></i>
                            </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    
        <main class="flex-fill">
        <div class="container">
        <div class="container text-warning">
    <h1>Carrinho de Compras</h1>

    <!-- Verifica se o carrinho possui produtos -->
    <?php if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) : ?>
        <ul class="list-group mb-3">
            <?php foreach ($_SESSION['carrinho'] as $produto) : ?>
                <li class="list-group-item py-3">
                    <div class="row g-3">
                        <div class="col-4 col-md-3 col-lg-2">
                            <?php echo "<img src='data:image/jpeg;base64,". $produto['imagem'] . "' class='img-thumbnail'>"; ?>
                        </div>
                        <div class="col-8 col-md-9 col-lg-7 col-xl-8 align-self-center">
                            <h4><b><a href="#" class="text-decoration-none text-bg-warning"><?php echo $produto['nome']; ?></a></b></h4>
                            <h5><?php echo $produto['descricao']; ?></h5>
                        </div>
                        <div class="col-6 offset-6 col-sm-6 offset-sm-6 col-md-4 offset-md-8 col-lg-3 offset-lg-0 col-xl-2 align-self-center mt-3">
                            <div class="input-group">
                                <div class="text-end mt-2">
                                    <small class="text-secondary">Valor unitário:</small>
                                    <span class="text-dark">R$<?php echo $produto['preco']; ?></span>
                                    <br>
                                    <span class="text-dark">Quantidade:<?php echo $produto['quantidade']; ?><br></span>
                                    <small class="text-secondary">Subtotal:</small>
                                    <span class="text-dark">R$<?php echo $produto['preco'] * $produto['quantidade']; ?></span>
                                </div>
                                <a href="excluir_produto.php?produto_id=<?php echo $produto['id'];?>" class="btn border-dark btn-danger btn-sm">
                                    <i class="bi-trash" style="font-size: 45px; line-height: 45px;" ></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
            <li class="list-group-item py-3">
                <div class="text-end">
                    <h4 class="text-dark text-bg-warning mb-3">
                        Valor total: R$<?php echo calcularTotalCarrinho($_SESSION['carrinho']); ?>
                    </h4>
                    <a href="index.php" class="btn btn-outline-warning btn-lg">
                        Continuar Comprando
                    </a>
                    <a href="carrinho.php?finalizado=true" class="btn btn-outline-warning btn-lg ms-2 mt-xs-3">
                        Fechar Compra
                    </a>

                    <?php if (isset($_GET['finalizado']) && $_GET['finalizado'] == 'true') : ?>
                    <div class="qr-code-container">
                        <img class="qr-code-overlay" src ="<?php echo $nomeArquivoQR; ?>" alt="QR Code" />
                        <p class="payment-message">Realizou o pagamento? Confirmaremos em instantes em seu Email.<br><a href="index.php"> Volte ao inicio </a></p>
                    </div>
                <?php endif; ?>

                </div>
            </li>
        </ul>
    <?php else : ?>
        <p class="text-warning"><a href="index.php"> carrinho está vazio.</a></p>
    <?php endif; ?>
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

        <script src=" /node_modules/bootstrap/dist/js/bootstrap.bundle.min.js "></script>

</body>

</html>