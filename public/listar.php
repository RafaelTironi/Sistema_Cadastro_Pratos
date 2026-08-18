<?php

include "../infra/conexao.php";

// Busca todos os usuários
$usuarios = mysqli_query($conexao, "SELECT * FROM usuarios");

// Verifica se foi selecionado algum usuário
$usuario_id = $_GET["usuario_id"] ?? null;

$pratos = null;

if ($usuario_id) {

    $sql = "SELECT * FROM pratos WHERE usuario_id = ?";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "i", $usuario_id);

    mysqli_stmt_execute($stmt);

    $pratos = mysqli_stmt_get_result($stmt);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Pratos por Usuário</title>
</head>

<body>

    <h1>Pratos por Usuário</h1>

    <!-- Selecionar usuário -->
    <form action="listar.php" method="GET">

        <label for="usuario_id">Usuário:</label>

        <select name="usuario_id" id="usuario_id" required>

            <option value="">Selecione um usuário</option>

            <?php while ($usuario = mysqli_fetch_assoc($usuarios)) { ?>

                <option value="<?php echo $usuario["id"]; ?>"
                    <?php if ($usuario_id == $usuario["id"]) echo "selected"; ?>>

                    <?php echo $usuario["nome"]; ?>

                </option>

            <?php } ?>

        </select>

        <button type="submit">Listar Pratos</button>

    </form>


    <?php if ($pratos) { ?>

        <h2>Pratos cadastrados</h2>

        <table>

            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Categoria</th>
            </tr>

            <?php while ($prato = mysqli_fetch_assoc($pratos)) { ?>

                <tr>

                    <td><?php echo $prato["id"]; ?></td>
                    <td><?php echo $prato["nome"]; ?></td>
                    <td><?php echo $prato["descricao"]; ?></td>
                    <td><?php echo $prato["preco"]; ?></td>
                    <td><?php echo $prato["categoria"]; ?></td>

                </tr>

            <?php } ?>

        </table>

    <?php } ?>

</body>

</html>