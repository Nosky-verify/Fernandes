<?php
session_start();
$nomeExibido = '';

if (isset($_SESSION['tipo_usuario'])) {
    $nomeExibido = $_SESSION['nome'];
}
?>


<?php

include 'conexao.php';

// Recupera as categorias para exibir no dropdown
$sql_categorias = "SELECT * FROM categorias";
$stmt_categorias = $pdo->query($sql_categorias);
$categorias = $stmt_categorias->fetchAll();

// Filtra os produtos pela categoria selecionada
$categoria = $_GET['categoria'] ?? 'Todos';

try {
    if ($categoria === 'Todos') {
        $sql_produtos = "SELECT * FROM produtos";
        $stmt_produtos = $pdo->prepare($sql_produtos);
        $stmt_produtos->execute();
    } else {
        $sql_produtos = "
            SELECT p.* FROM produtos p
            JOIN categorias c ON p.categoria_id = c.id
            WHERE c.nome = :categoria
        ";
        $stmt_produtos = $pdo->prepare($sql_produtos);
        $stmt_produtos->execute(['categoria' => $categoria]);
    }

    $produtos = $stmt_produtos->fetchAll();
} catch (PDOException $e) {
    echo "Erro ao carregar produtos: " . $e->getMessage();
    die();
}
session_start();
include 'conexao.php';

$nomeExibicao = '';

if (isset($_SESSION['id']) && isset($_SESSION['tipo_usuario'])) {
    $id = $_SESSION['id'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    try {
        if ($tipo_usuario === 'usuario') {
            $sql = "SELECT nome FROM usuarios WHERE id = :id";
        } elseif ($tipo_usuario === 'empresa') {
            $sql = "SELECT nome FROM empresas WHERE id = :id";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $resultado = $stmt->fetch();

        if ($resultado) {
            $nomeExibicao = $resultado['nome'];
        }
    } catch (PDOException $e) {
        echo "Erro ao buscar nome: " . $e->getMessage();
    }
}
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluguer e Arrendamento</title>
    <link rel="stylesheet" href="e.css">
    <style>
        .perfil-usuario {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 16px;
    font-weight: bold;
    color: #333;
}
.perfil-usuario a {
    color: black;
    font-weight: bold;
}

.perfil-usuario a:hover {
    text-decoration: underline;
    color: #f0a500;
}

.user-info {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 10px;
}

.logout-btn {
    margin-left: 20px;
    padding: 5px 10px;
    background-color: #f44336; /* Vermelho */
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
}

.logout-btn:hover {
    background-color: #d32f2f;
}



    </style>
</head>
<body>

<header>
    <h1>Bem-vindo ao Aluguer e Arrendamento</h1>
    <div>
        <?php if (!empty($nomeExibido)): ?>
            <a href="perfil.php"><?= htmlspecialchars($nomeExibido) ?></a> |
            <a href="logout.php">Sair</a>
        <?php else: ?>
            <a href="login.php">Entrar</a>
        <?php endif; ?>
    </div>
</header>

    <main>
        
    <section id="categorias">
    <h1>Categorias de Produtos</h1>
    <form method="GET" action="">
        <select name="categoria" onchange="this.form.submit()">
            <option value="Todos" <?= $categoria === 'Todos' ? 'selected' : '' ?>>Todos</option>
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= htmlspecialchars($cat['nome']) ?>" <?= $categoria === $cat['nome'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
    </section>
</div>
                <br>
            <!--  SECCÃO DE PRODUTOS-->
            <!--  SECCÃO DE PRODUTOS-->
<div class="seccaodoproduto">


<div class="textodoproduto">
    <?php
        include 'conexao.php';
        
        // Captura a categoria selecionada
        $categoria = $_GET['categoria'] ?? 'Todos';
        
        // Exibir o nome da categoria acima de Produtos
        if ($categoria !== 'Todos') {
            echo "<h2> " . htmlspecialchars($categoria) . "</h2>";
        }
        ?>
         

    </div>
            <section id="produtos">
    

    <?php
        include 'conexao.php';
        
        // Captura a categoria selecionada
        $categoria = $_GET['categoria'] ?? 'Todos';
        
        // Exibir nome da categoria
       

        // Preparar a consulta
        try {
            $sql = $categoria === 'Todos' 
                ? "SELECT p.*, c.nome AS categoria_nome FROM produtos p LEFT JOIN categorias c ON p.categoria_id = c.id"
                : "SELECT p.*, c.nome AS categoria_nome FROM produtos p JOIN categorias c ON p.categoria_id = c.id WHERE c.nome = :categoria";

            $stmt = $pdo->prepare($sql);
            if ($categoria !== 'Todos') {
                $stmt->execute(['categoria' => $categoria]);
            } else {
                $stmt->execute();
            }

            $produtos = $stmt->fetchAll();

            if ($produtos):
    ?>
        <div class="produtos-container">
            <?php foreach ($produtos as $produto): ?>
                <div class="produto">
                    <h3><?= htmlspecialchars($produto['titulo']) ?></h3>

                    <img style="  
                    width: 200px; height: auto; object-fit: cover;

" src="imagens/produtos/<?= htmlspecialchars($produto['foto_produto']) ?>" alt="<?= htmlspecialchars($produto['titulo']) ?>" />






                    <p><?= htmlspecialchars($produto['descricao']) ?></p>
                    
                    <!-- Botão de negociação -->
                    <button class="btn-negociar" onclick="openModal(<?= $produto['id'] ?>)">Negociar</button>
                </div>
            <?php endforeach; ?>
        </div>
    <?php
            else:
    ?>
        <p>Nenhum produto encontrado!</p>
    <?php
            endif;
        } catch (PDOException $e) {
            echo "Erro ao carregar os produtos: " . $e->getMessage();
        }
    ?>
</section>


<!-- Modal para negociação -->
<div id="modal-negociar" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3>Negociar Aluguel</h3>
        
        <!-- Formulário de negociação -->
        <div id="opcoes-negociacao">
            <div class="opcao-preco">
                <input type="radio" id="semanal" name="negociacao" value="semanal" onclick="atualizarPreco('semanal')" />
                <label for="semanal">Semanal: </label>
                <span id="preco-semanal" class="preco">R$ 0,00</span>
            </div>
            <div class="opcao-preco">
                <input type="radio" id="mensal" name="negociacao" value="mensal" onclick="atualizarPreco('mensal')" />
                <label for="mensal">Mensal: </label>
                <span id="preco-mensal" class="preco">R$ 0,00</span>
            </div>
            <div class="opcao-preco">
                <input type="radio" id="anual" name="negociacao" value="anual" onclick="atualizarPreco('anual')" />
                <label for="anual">Anual: </label>
                <span id="preco-anual" class="preco">R$ 0,00</span>
            </div>
            
            <button onclick="confirmarNegociacao()">Confirmar Negociação</button>
        </div>
    </div>
</div>


<!--  SECCÃO DE PRODUTOS TERMINOU AQUI-->
<!--  SECCÃO DE PRODUTOS TERMINOU AQUI-->


    </main>

   


    <footer>
        <p>Contato: delciofernandes77@gmail.com | (+244) 931 769 945</p>
        <p>&copy; <?= date('Y') ?> Aluguer e Arrendamento. Todos os direitos reservados.</p>
    </footer>
    


    <script>
 // Função para abrir o modal
function openModal(produtoId) {
    const modal = document.getElementById("modal-negociar");
    
    // Defina os preços para cada tipo de negociação
    const precoSemanal = 1000; // Preço semanal exemplo
    const precoMensal = 3500;  // Preço mensal exemplo
    const precoAnual = 42000;  // Preço anual exemplo

    // Exibe os preços para cada opção
    document.getElementById("preco-semanal").textContent = `AOA ${precoSemanal.toFixed(2)}`;
    document.getElementById("preco-mensal").textContent = `AOA ${precoMensal.toFixed(2)}`;
    document.getElementById("preco-anual").textContent = `AOA ${precoAnual.toFixed(2)}`;

    // Limpando a seleção anterior
    const radios = document.getElementsByName("negociacao");
    radios.forEach(radio => radio.checked = false);

    modal.style.display = "flex"; // Exibir o modal
}

// Função para fechar o modal
function closeModal() {
    const modal = document.getElementById("modal-negociar");
    modal.style.display = "none"; // Ocultar o modal
}

// Função para atualizar o preço com base na opção escolhida
function atualizarPreco(opcao) {
    let preco = 0;

    // Atribui o preço de acordo com a opção selecionada
    if (opcao === 'semanal') {
        preco = 1000;
    } else if (opcao === 'mensal') {
        preco = 3500;
    } else if (opcao === 'anual') {
        preco = 42000;
    }

    // Atualiza o preço na interface
    alert(`Preço escolhido: AOA ${preco.toFixed(2)}`);
}

// Função para confirmar a negociação
function confirmarNegociacao() {
    const selectedOption = document.querySelector('input[name="negociacao"]:checked');
    
    if (selectedOption) {
        const negociacao = selectedOption.value;
        alert(`Negociação confirmada para opção: ${negociacao}`);
        closeModal();
    } else {
        alert("Selecione uma opção de negociação antes de confirmar.");
    }
}

    </script>
</body>
</html>
