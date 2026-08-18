<?php
include "../infra/conexao.php";

$id = $_GET["id"];

$sql = "SELECT * FROM pratos WHERE id = ?";

$stmt = mysqli_prepare($conexao, $sql);

if ($stmt) {

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    $pratos = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Sistema Pratos</title>
    <link rel="stylesheet" href="style/styles.css">
</head>

<body>
    <header>
        <h1>CRUD - Livraria</h1>
    </header>
    <main>
        <h2>Editando o prato <?php echo $pratos["titulo"]?>!</h2>
        <form action="atualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $pratos["id"]?>">

            <label for="titulo">Título:</label>
            <input type="text" name="nome_prato" value="<?php echo $pratos["nome_prato"]?>">
            <br>
            <label for="autor">Autor:</label>
            <input type="text" name="desc" value="<?php echo $pratos["desc"]?>">
            <br>
            <label for="ano">Ano de Publicação:</label>
            <input type="number" name="preco" value="<?php echo $pratos["preco"]?>">
            <br>
            <input type="number" name="categoria" value="<?php echo $pratos["categoria"]?>">
            <br>
            <button type="submit">Atualizar</button>
        </form>

    </main>
    <footer>

    </footer>


</body>

</html>