<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'empresa') {
    header('Location: login.php');
    exit();
}

include 'conexao.php';

// Recuperar categorias para exibir no dropdown
$sql = "SELECT * FROM categorias";
$stmt = $pdo->query($sql);
$categorias = $stmt->fetchAll();
?>
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

    // Verificar se a imagem foi enviada sem erro
    $foto_produto = '';
    if (isset($_FILES['foto_produto']) && $_FILES['foto_produto']['error'] === UPLOAD_ERR_OK) {
        // Obter a extensão da imagem
        $extensao = pathinfo($_FILES['foto_produto']['name'], PATHINFO_EXTENSION);

        // Gerar um nome único para o arquivo
        $foto_produto = uniqid() . '.' . $extensao;

        // Definir o caminho completo para o arquivo
        $upload_dir = 'imagens/produtos/';
        $upload_path = $upload_dir . $foto_produto;

        // Verificar se o diretório de upload existe
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Cria o diretório se não existir
        }

        // Mover o arquivo para o diretório de upload
        if (!move_uploaded_file($_FILES['foto_produto']['tmp_name'], $upload_path)) {
            echo "Erro ao mover a imagem para o diretório.";
        }
    } else {
        // Caso não seja enviada uma imagem, pode-se definir uma imagem padrão
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
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
</head>
<body>
    <h2>Adicionar Produto</h2>
    <form action="processar_produto.php" method="POST" enctype="multipart/form-data">
        <label for="titulo">Título do Produto:</label>
        <input type="text" id="titulo" name="titulo" required>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="4" required></textarea>

        <label for="foto_produto">Foto do Produto:</label>
        <input type="file" name="foto_produto" required>

        <label for="preco">Preço (AOA):</label>
        <input type="number" id="preco" name="preco" step="0.01" required>

        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" required>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>"><?= htmlspecialchars($categoria['nome']) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Adicionar Produto</button>
    </form>
</body>
</html>
