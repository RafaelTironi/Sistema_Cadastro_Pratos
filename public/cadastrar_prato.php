<?php


include "../infra/conexao.php";

$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$categoria = $_POST["categoria"]
//query
$sql = "INSERT INTO pratos (nome, descricao ,preco, categoria) VALUES (?,?,?,?)";

if(stmt){

$stmt=mysqli_prepare($conexao, $sql)

mysqli_stmt_bind_param($stmt, "ssds", $nome, $descricao, $preco, $categoria );

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
}


header("Location: ../index.php");
exist();

?>