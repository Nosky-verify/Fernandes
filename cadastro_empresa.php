<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Empresa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Cadastro de Empresa</h2>
    <form action="processar_empresa.php" method="POST" enctype="multipart/form-data">
        <label for="nome">Nome da Empresa:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <label for="foto_perfil">Foto de Perfil:</label>
        <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*" required>

        <label for="descricao">Descrição da Empresa:</label>
        <textarea id="descricao" name="descricao" rows="4" required></textarea>

        <label for="provincia">Província:</label>
        <input type="text" id="provincia" name="provincia" required>

        <label for="municipio">Município:</label>
        <input type="text" id="municipio" name="municipio" required>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
