<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    include 'conexao.php';

    // Validar os dados do formulário
    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;
    $descricao = $_POST['descricao'] ?? null;
    $provincia = $_POST['provincia'] ?? null;
    $municipio = $_POST['municipio'] ?? null;

    if (!$nome || !$email || !$senha || !$descricao || !$provincia || !$municipio) {
        die("Erro: Todos os campos são obrigatórios.");
    }

    // Upload da foto de perfil
    $fotoPerfil = null;
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION);
        $nomeArquivo = uniqid() . '.' . $extensao;
        $destino = 'imagens/perfil/' . $nomeArquivo;

        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $destino)) {
            $fotoPerfil = $nomeArquivo;
        } else {
            die("Erro ao fazer upload da foto de perfil.");
        }
    }

    // Inserir na base de dados
    try {
        $hashSenha = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO empresas (nome, email, senha, foto_perfil, descricao, provincia, municipio) 
                VALUES (:nome, :email, :senha, :foto_perfil, :descricao, :provincia, :municipio)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => $hashSenha,
            'foto_perfil' => $fotoPerfil,
            'descricao' => $descricao,
            'provincia' => $provincia,
            'municipio' => $municipio,
        ]);

        $_SESSION['id'] = $pdo->lastInsertId();
        $_SESSION['tipo_usuario'] = 'empresa';
        $_SESSION['nome'] = $nome;

        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        die("Erro ao salvar os dados: " . $e->getMessage());
    }
} else {
    die("Acesso inválido.");
}
?>
