<?php
// salvar.php - insere novo produto ou atualiza se id for enviado
require 'inc/conexao.php';

// captura e limpa dados
$id = isset($_POST['id']) && $_POST['id'] !== '' ? intval($_POST['id']) : null;
$nome = trim($_POST['nome'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$preco = isset($_POST['preco']) ? str_replace(',', '.', $_POST['preco']) : 0;
$categoria_id = isset($_POST['categoria_id']) ? intval($_POST['categoria_id']) : 0;

// validações servidor
$erros = [];
if ($nome === '') $erros[] = "Nome é obrigatório.";
if ($categoria_id <= 0) $erros[] = "Selecione uma categoria válida.";
if (!is_numeric($preco) || floatval($preco) < 0) $erros[] = "Preço inválido.";

if (count($erros) > 0) {
    // mostrar erros simples
    echo "<p><strong>Erros:</strong></p><ul>";
    foreach ($erros as $e) echo "<li>" . htmlspecialchars($e) . "</li>";
    echo "</ul><p><a href='javascript:history.back()'>Voltar</a></p>";
    exit;
}

if ($id) {
    // UPDATE com prepared statement
    $stmt = $con->prepare("UPDATE produtos SET nome = ?, descricao = ?, preco = ?, categoria_id = ? WHERE id = ?");
    $preco_f = floatval($preco);
    $stmt->bind_param('ssdii', $nome, $descricao, $preco_f, $categoria_id, $id);
    if ($stmt->execute()) {
        header("Location: admin.php?msg=editado");
        exit;
    } else {
        die("Erro ao atualizar: " . $con->error);
    }
} else {
    // INSERT com prepared statement
    $stmt = $con->prepare("INSERT INTO produtos (nome, descricao, preco, categoria_id) VALUES (?, ?, ?, ?)");
    $preco_f = floatval($preco);
    $stmt->bind_param('ssdi', $nome, $descricao, $preco_f, $categoria_id);
    if ($stmt->execute()) {
        header("Location: admin.php?msg=criado");
        exit;
    } else {
        die("Erro ao inserir: " . $con->error);
    }
}
?>
