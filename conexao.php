<?php
$host = "localhost"; // Endereço do servidor do banco de dados
$usuario = "root"; // Nome de usuário do banco de dados
$senha = ""; // Senha do banco de dados
$banco = "inovatech"; // Nome do banco de dados

// Cria uma conexão com o banco de dados
$mysqli = new mysqli($host, $usuario, $senha, $banco);

// Verifica se ocorreu algum erro na conexão
if ($mysqli->connect_errno) {
    echo "Falha na conexão com o banco de dados: " . $mysqli->connect_error;
    exit();
}



function adicionarAoCarrinho($produto_id, $produto_descricao, $produto_nome, $produto_imagem, $produto_preco) {
    // Iniciar a sessão (caso ainda não tenha sido iniciada)
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Verificar se o carrinho já existe na sessão
    if (isset($_SESSION['carrinho'])) {
        // Verificar se o produto já está no carrinho
        $produto_encontrado = false;
        foreach ($_SESSION['carrinho'] as &$produto) {
            if ($produto['id'] === $produto_id) {
                // O produto já está no carrinho, então apenas atualize a quantidade
                $produto['quantidade']++;
                $produto_encontrado = true;
                break;
            }
        }

        if (!$produto_encontrado) {
            // Adicionar o produto ao carrinho
            $novo_produto = array(
                'id' => $produto_id,
                'nome' => $produto_nome,
                'descricao' => $produto_descricao,
                'imagem' => $produto_imagem,
                'preco' => $produto_preco,
                'quantidade' => 1
            );

            $_SESSION['carrinho'][] = $novo_produto;
        }
    } else {
        // O carrinho ainda não existe na sessão, então crie-o
        $_SESSION['carrinho'] = array();

        // Adicionar o primeiro produto ao carrinho
        $novo_produto = array(
            'id' => $produto_id,
            'nome' => $produto_nome,
            'descricao' => $produto_descricao,
            'imagem' => $produto_imagem,
            'preco' => $produto_preco,
            'quantidade' => 1
        );

        $_SESSION['carrinho'][] = $novo_produto;
    }
}

// Função para remover um produto do carrinho
function removerDoCarrinho($produto_id) {
    // Iniciar a sessão (caso ainda não tenha sido iniciada)
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Verificar se o carrinho existe na sessão
    if (isset($_SESSION['carrinho'])) {
        // Procurar o produto no carrinho
        foreach ($_SESSION['carrinho'] as $index => $produto) {
            if ($produto['id'] === $produto_id) {
                // Remover o produto do carrinho
                unset($_SESSION['carrinho'][$index]);
                return;
            }
        }
    }
}

// Função para calcular o total do carrinho
function calcularTotalCarrinho($carrinho) {
    $total = 0;

    foreach ($carrinho as $produto) {
        if (isset($produto['preco']) && isset($produto['quantidade'])) {
            $preco = $produto['preco'];
$quantidade = $produto['quantidade'];
$subtotal = $preco * $quantidade;
$total += $subtotal;
        }
    }

    return $total;

    
}

?>