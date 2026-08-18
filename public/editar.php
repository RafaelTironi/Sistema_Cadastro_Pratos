<?php
include "../infra/conexao.php";

// 1. Recebe o nome vindo da URL (ex: editar.php?nome=Pizza)
if (!isset($_GET["nome"]) || empty($_GET["nome"])) {
    die("O nome do prato não foi informado na URL.");
}

$nome_busca = $_GET["nome"];

// 2. Busca no banco de dados utilizando a coluna 'nome'
$sql = "SELECT * FROM pratos WHERE nome = ?";
$stmt = mysqli_prepare($conexao, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $nome_busca);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $prato = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($stmt);
}

// 3. Se o prato não for encontrado
if (!$prato) {
    die("Prato não encontrado no banco de dados.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Editar Prato</title>
    <link rel="stylesheet" href="style/styles.css">
</head>

<body>
    <header>
        <h1>Sistema Pratos - Atualizar</h1>
    </header>
    <main>
        <h2>Editando o prato: <?php echo $prato["nome"]; ?>!</h2>

        <form action="editar.php" method="POST">
            <!-- Guarda o nome antigo para ser usado na cláusula WHERE do UPDATE -->
            <input type="hidden" name="nome_antigo" value="<?php echo $prato["nome"]; ?>">

            <label for="nome_prato">Nome do prato:</label>
            <input type="text" name="nome_prato" value="<?php echo $prato["nome"]; ?>" required>
            <br>

            <label for="desc">Descrição:</label>
            <input type="text" name="desc" value="<?php echo $prato["descricao"]; ?>">
            <br>

            <label for="preco">Preço:</label>
            <input type="number" step="0.01" name="preco" value="<?php echo $prato["preco"]; ?>" required>
            <br>

            <label for="categoria">Categoria:</label>
            <input type="text" name="categoria" value="<?php echo $prato["categoria"]; ?>" required>
            <br>

            <button type="submit">Atualizar</button>
        </form>
    </main>
    <footer></footer>
</body>

</html>