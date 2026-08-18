<?php

include "../infra/conexao.php";

// ==========================
// PARTE 1 - ATUALIZAR
// ==========================

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $nome = $_POST["nome_prato"];
    $descricao = $_POST["desc"];
    $preco = $_POST["preco"];
    $categoria = $_POST["categoria"];
    $nome_usuario = $_POST["nome_usuario"];

    // Procura o usuário pelo nome
    $sql = "SELECT id FROM usuarios WHERE nome = ?";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "s", $nome_usuario);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($stmt);

    // Verifica se o usuário existe
    if (!$usuario) {
        die("Usuário não encontrado.");
    }

    $usuario_id = $usuario["id"];

    // Atualiza o prato
    $sql = "UPDATE pratos 
            SET nome = ?, descricao = ?, preco = ?, categoria = ?, usuario_id = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param(
            $stmt,
            "ssdsii",
            $nome,
            $descricao,
            $preco,
            $categoria,
            $usuario_id,
            $id
        );

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }

    header("Location: ../index.php");
    exit();
}


// ==========================
// PARTE 2 - BUSCAR O PRATO
// ==========================

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    die("O ID do prato não foi informado.");
}

$id = $_GET["id"];

$sql = "SELECT pratos.*, usuarios.nome AS nome_usuario
        FROM pratos
        INNER JOIN usuarios ON pratos.usuario_id = usuarios.id
        WHERE pratos.id = ?";

$stmt = mysqli_prepare($conexao, $sql);

if ($stmt) {

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $prato = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($stmt);
}

if (!$prato) {
    die("Prato não encontrado.");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CRUD - Editar Prato</title>

    <link rel="stylesheet" href="../style/styles.css">
</head>

<body>

    <header>
        <h1>Sistema Pratos - Atualizar</h1>
    </header>

    <main>

        <h2>Editando o prato: <?php echo $prato["nome"]; ?>!</h2>

        <form action="editar.php" method="POST">

            <!-- ID do prato -->
            <input 
                type="hidden" 
                name="id" 
                value="<?php echo $prato["id"]; ?>"
            >

            <label for="nome_prato">Nome do prato:</label>

            <input 
                type="text" 
                name="nome_prato" 
                value="<?php echo $prato["nome"]; ?>" 
                required
            >

            <br>

            <label for="desc">Descrição:</label>

            <input 
                type="text" 
                name="desc" 
                value="<?php echo $prato["descricao"]; ?>"
            >

            <br>

            <label for="preco">Preço:</label>

            <input 
                type="number" 
                step="0.01" 
                name="preco" 
                value="<?php echo $prato["preco"]; ?>" 
                required
            >

            <br>

            <label for="categoria">Categoria:</label>

            <input 
                type="text" 
                name="categoria" 
                value="<?php echo $prato["categoria"]; ?>" 
                required
            >

            <br>

            <label for="nome_usuario">Usuário:</label>

            <input 
                type="text" 
                name="nome_usuario" 
                value="<?php echo $prato["nome_usuario"]; ?>" 
                required
            >

            <br>

            <button type="submit">Atualizar</button>

        </form>

    </main>

</body>

</html>