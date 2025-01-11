<?php
session_start();
include 'conexao.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'empresa') {
    header('Location: login.php');
    exit;
}

$id = $_SESSION['id'];
$tipo_usuario = $_SESSION['tipo_usuario'];

try {
    $sql = "SELECT nome, email, descricao, endereco, foto_perfil FROM empresas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $dados = $stmt->fetch();

    if (!$dados) {
        die("Dados do perfil não encontrados.");
    }
} catch (PDOException $e) {
    die("Erro ao buscar dados do perfil: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Empresa</title>
    <link rel="stylesheet" href="perfil.css">
</head>
<body>
    <header>
        <h1>Perfil de <?= htmlspecialchars($dados['nome']) ?></h1>
    </header>

    <main class="perfil-container">
        <div class="perfil-foto">
            <img src="/Arrendamento/imagens/perfil/<?= htmlspecialchars($dados['foto_perfil']) ?>" alt="Foto de Perfil">
        </div>
        <div class="perfil-info">
            <p><strong>Nome:</strong> <?= htmlspecialchars($dados['nome']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($dados['email']) ?></p>
            <p><strong>Descrição:</strong> <?= htmlspecialchars($dados['descricao']) ?></p>
            <p><strong>Endereço:</strong> <?= htmlspecialchars($dados['endereco']) ?></p>

            <!-- Link para a página de adicionar produtos -->
            <p><a href="adicionar_produto.php">Clique aqui para adicionar um novo produto</a></p>
        </div>
    </main>

    <footer>
        <a href="index.php">Voltar para a Página Inicial</a>
    </footer>
</body>
</html>
