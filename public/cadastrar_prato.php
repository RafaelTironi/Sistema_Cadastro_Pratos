<?php

include "../infra/conexao.php";

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

// Pega o ID do usuário
$usuario_id = $usuario["id"];

// Cadastra o prato
$sql = "INSERT INTO pratos 
        (nome, descricao, preco, categoria, usuario_id) VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conexao, $sql);

if ($stmt) {

    mysqli_stmt_bind_param(
        $stmt,
        "ssdsi",
        $nome,
        $descricao,
        $preco,
        $categoria,
        $usuario_id
    );

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}

header("Location: ../index.php");
exit();

?>