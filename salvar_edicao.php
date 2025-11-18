<?php
require 'inc/conexao.php';

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$nome = trim($_POST['nome'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$preco = isset($_POST['preco']) ? str_replace(',', '.', $_POST['preco']) : 0;
$categoria_id = isset($_POST['categoria_id']) ? intval($_POST['categoria_id']) : 0;

if ($id <= 0) {
    die("ID inválido.");
}

// validações simples
if ($nome === '' || $categoria_id <= 0 || !is_numeric($preco)) {
    die("Dados inválidos.");
}

$stmt = $con->prepare("UPDATE produtos SET nome = ?, descricao = ?, preco = ?, categoria_id = ? WHERE id = ?");
$preco_f = floatval($preco);
$stmt->bind_param('ssdii', $nome, $descricao, $preco_f, $categoria_id, $id);
if ($stmt->execute()) {
    header("Location: admin.php?msg=editado");
    exit;
} else {
    die("Erro ao atualizar: " . $con->error);
}
?>
