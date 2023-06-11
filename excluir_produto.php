<?php
// Inicia a sessão
session_start();

include('conexao.php');

// Verifica se o usuário não está logado
if (!isset($_SESSION['user_nome'])) {
  // Redireciona para a página de login
  header('Location: login.php');
  exit; // Encerra o script atual
}

// Verifica se o ID do produto a ser excluído foi fornecido
if (isset($_GET['produto_id'])) {
    $produto_id = $_GET['produto_id'];
    
    // Remove o produto do carrinho
    removerDoCarrinho($produto_id);
    
    header('Location: carrinho.php');
    exit;
} else {
    // Redireciona para a página de carrinho
    header('Location: carrinho.php');
    exit;
}
?>