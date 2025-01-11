
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link rel="stylesheet" href="estilos.css">

    <style>

/* Reset de Estilos */
body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    box-sizing: border-box;
}

/* Estilo para o corpo */
body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f7f7f7;
    margin: 0;
}

/* Container principal */
.container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 400px;
    padding: 20px;
    text-align: center;
}

/* Título */
.container h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

/* Labels */
.container label {
    display: block;
    text-align: left;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
}

/* Inputs */
.container input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

.container input:focus {
    border-color: #007BFF;
    outline: none;
    box-shadow: 0 0 4px rgba(0, 123, 255, 0.3);
}

/* Botão */
.container button {
    background-color: #007BFF;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
}

.container button:hover {
    background-color: #0056b3;
}

/* Link de cadastro */
p.register-link {
    margin-top: 15px;
    font-size: 14px;
    color: #555;
}

p.register-link a {
    color: #007BFF;
    text-decoration: none;
}

p.register-link a:hover {
    text-decoration: underline;
}

/* Responsividade */
@media (max-width: 500px) {
    .container {
        padding: 15px;
        width: 90%;
    }
    .container h2 {
        font-size: 20px;
    }
}


    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="processar_login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email" required>
            
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            
            <button type="submit">Entrar</button>
            
            <p class="register-link">
                Não tem uma conta? <a href="cadastro_usuario.php">Cadastre-se como Usuário</a> ou <a href="cadastro_empresa.php">Cadastre-se como Empresa</a>.
            </p>
        </form>
    </div>
</body>
</html>
