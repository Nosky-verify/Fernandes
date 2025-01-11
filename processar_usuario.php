<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = password_hash($_POST['senha'] ?? '', PASSWORD_BCRYPT);
    $endereco = $_POST['endereco'] ?? '';
    $fotoPerfil = '';

    // Verificar se há upload de foto
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION);
        $novoNome = uniqid('perfil_') . '.' . $extensao;
        $destino = "imagens/perfil/" . $novoNome;

        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $destino)) {
            $fotoPerfil = $novoNome;
        } else {
            die("Erro ao salvar a foto de perfil.");
        }
    }

    try {
        $sql = "INSERT INTO usuarios (nome, email, senha, endereco, foto_perfil) 
                VALUES (:nome, :email, :senha, :endereco, :foto_perfil)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha,
            'endereco' => $endereco,
            'foto_perfil' => $fotoPerfil
        ]);

        echo "Cadastro realizado com sucesso!";
    } catch (PDOException $e) {
        die("Erro ao salvar os dados: " . $e->getMessage());
    }
}

if ($stmt->rowCount()) {
    echo "Usuário cadastrado com sucesso!";
    header("Location: index.php");
    exit(); // Importante para garantir que o restante do código não será executado
} else {
    echo "Erro ao cadastrar o usuário.";
}


if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
    $extensao = pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION);
    $novo_nome = uniqid() . '.' . $extensao;
    move_uploaded_file($_FILES['foto_perfil']['tmp_name'], 'imagens/perfil/' . $novo_nome);

    // Atualize o nome da foto no banco de dados
    $sql = "UPDATE usuarios SET foto_perfil = :foto_perfil WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['foto_perfil' => $novo_nome, 'id' => $id]);
}

?>
