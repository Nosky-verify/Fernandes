<?php
session_start();
include 'conexao.php';

// Verificar se o usuário está logado e é uma empresa
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'empresa') {
    header('Location: login.php');
    exit;
}

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coletar dados do formulário
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $categoria_id = $_POST['categoria'];
    $preco = $_POST['preco'];

    // Verificar se a imagem foi enviada
    $foto_produto = '';
    if (isset($_FILES['foto_produto']) && $_FILES['foto_produto']['error'] === UPLOAD_ERR_OK) {
        // Obter a extensão da imagem
        $extensao = pathinfo($_FILES['foto_produto']['name'], PATHINFO_EXTENSION);

        // Gerar um nome único para o arquivo
        $foto_produto = uniqid() . '.' . $extensao;

        // Mover o arquivo para o diretório de imagens
        move_uploaded_file($_FILES['foto_produto']['tmp_name'], 'imagens/produtos/' . $foto_produto);
    } else {
        // Caso não seja enviada uma imagem, podemos definir uma imagem padrão
        $foto_produto = 'default.jpg';
    }

    try {
        // Inserir o produto no banco de dados
        $sql = "INSERT INTO produtos (titulo, descricao, categoria_id, preco, foto_produto, empresa_id) 
                VALUES (:titulo, :descricao, :categoria_id, :preco, :foto_produto, :empresa_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'titulo' => $titulo,
            'descricao' => $descricao,
            'categoria_id' => $categoria_id,
            'preco' => $preco,
            'foto_produto' => $foto_produto,
            'empresa_id' => $_SESSION['id']
        ]);

        // Redirecionar após sucesso
        header('Location: index.php'); // Redireciona para a página inicial
        exit;
    } catch (PDOException $e) {
        // Exibir mensagem de erro caso ocorra algum problema
        echo "Erro ao adicionar produto: " . $e->getMessage();
    }
}


if (isset($_FILES['foto_produto']) && $_FILES['foto_produto']['error'] === UPLOAD_ERR_OK) {
    // Obter a extensão da imagem
    $extensao = pathinfo($_FILES['foto_produto']['name'], PATHINFO_EXTENSION);
    
    // Gerar um nome único para o arquivo
    $foto_produto = uniqid() . '.' . $extensao;
    
    // Definir o caminho para salvar a imagem
    $upload_dir = 'imagens/produtos/';
    $upload_file = $upload_dir . $foto_produto;
    
    // Verificar se o diretório existe
    if (!is_dir($upload_dir)) {
        die("O diretório de upload não existe. Por favor, crie a pasta 'imagens/produtos'.");
    }

    // Tentar mover o arquivo para o diretório de imagens
    if (move_uploaded_file($_FILES['foto_produto']['tmp_name'], $upload_file)) {
        echo "Arquivo movido com sucesso: " . $upload_file;
    } else {
        echo "Erro ao tentar mover o arquivo para o diretório.";
    }
} else {
    // Caso não seja enviada uma imagem, podemos definir uma imagem padrão
    $foto_produto = 'default.jpg';
}

?>
