<?php
require 'inc/conexao.php';

if (empty($_GET['id'])) {
    header("Location: admin.php");
    exit;
}
$id = intval($_GET['id']);

$stmt = $con->prepare("DELETE FROM produtos WHERE id = ?");
$stmt->bind_param('i', $id);
if ($stmt->execute()) {
    header("Location: admin.php?msg=excluido");
    exit;
} else {
    die("Erro ao excluir: " . $con->error);
}
?>
