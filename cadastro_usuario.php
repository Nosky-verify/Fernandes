<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="/estiloform.css">

    <style>

        /* Configurações gerais */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    padding: 20px;
    width: 90%;
    max-width: 400px;
}

h2 {
    text-align: center;
    color: #555;
    margin-bottom: 20px;
    font-size: 24px;
}

/* Estilos do formulário */
form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
    font-weight: bold;
    font-size: 14px;
}

input, textarea, button {
    margin-bottom: 15px;
    padding: 10px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ddd;
    width: 100%;
}

textarea {
    resize: none;
    height: 100px;
}

input[type="file"] {
    padding: 3px;
}

button {
    background-color: #007BFF;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}

/* Adicionar responsividade */
@media (max-width: 500px) {
    body {
        padding: 10px;
    }
    .container {
        width: 100%;
        padding: 15px;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Usuário</h2>
        <form action="processar_usuario.php" method="POST" enctype="multipart/form-data">
            <label for="nome">Nome Completo</label>
            <input type="text" id="nome" name="nome" required>

            <label for="endereco">Endereço</label>
            <input type="text" id="endereco" name="endereco" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>

            <label for="foto">Foto de Perfil</label>
             <!-- Outros campos -->
    <input type="file" name="foto_perfil">
    <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
