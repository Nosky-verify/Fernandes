<?php
session_start();
include 'conexao.php';

$email = $_POST['email'] ?? null;
$senha = $_POST['senha'] ?? null;

if (!$email || !$senha) {
    die("Erro: Preencha todos os campos.");
}

try {
    // Verifica o tipo de usuário
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['tipo_usuario'] = 'usuario';
        header("Location: index.php");
        exit();
    }

    // Verifica o tipo de empresa
    $sql = "SELECT * FROM empresas WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $empresa = $stmt->fetch();

    if ($empresa && password_verify($senha, $empresa['senha'])) {
        $_SESSION['id'] = $empresa['id'];
        $_SESSION['nome'] = $empresa['nome'];
        $_SESSION['tipo_usuario'] = 'empresa';
        header("Location: index.php");
        exit();
    }

    // Se nenhum login for válido
    die("Erro: Email ou senha inválidos.");
} catch (PDOException $e) {
    die("Erro ao processar o login: " . $e->getMessage());
}
?>
