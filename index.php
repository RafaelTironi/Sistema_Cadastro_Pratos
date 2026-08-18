<?php

include "infra/conexao.php";
$pratos = mysqli_query($conexao, "SELECT * FROM pratos");

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
        <h1>CRUD - Sistema Pratos</h1>
    </header>
    <main>
        <h2>Adicione um novo prato!</h2>
        <form action="public/cadastrar_prato.php" method="POST">
            <label for="Nome_Prato">Nome:</label>
            <input type="text" name="nome_prato">
            <br>
            <label for="Desc">Descrição:</label>
            <input type="text" name="desc">
            <br>
            <label for="Preco">Preço:</label>
            <input type="number" name="preco">
            <br>
            <label for="Categoria">Categoria:</label>
            <input type="text" name="categoria">
            <br>
            <button type="submit">Cadastrar</button>
        </form>
        <div>
            <h2>Pratos Cadastrados</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
                <?php while ($pratos = mysqli_fetch_assoc($pratos)) { ?>
                    <tr>
                        <td><?php echo $pratos["id"] ?></td>
                        <td><?php echo $pratos["nome"] ?></td>
                        <td><?php echo $pratos["descricao"] ?></td>
                        <td><?php echo $pratos["preco"] ?></td>
                        <td><?php echo $pratos["categoria"] ?></td>
                        <td>
                            <a href="public/editar.php?id=<?php echo $pratos["id"] ?>">Editar</a>
                            <a href="public/excluir.php?id=<?php echo $pratos["id"] ?>">Excluir</a>
                            <a href="public/listar.php?id=<?php echo $pratos["id"] ?>">Listar Por Usuário</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

    </main>
    <footer>

    </footer>


</body>

</html>