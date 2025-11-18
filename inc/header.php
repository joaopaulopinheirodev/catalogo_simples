<?php
// inc/header.php - cabeçalho responsável por abrir HTML e carregar CSS/JS
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Catálogo Simples</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header class="topbar">
  <div class="container nav-container">
    <div class="logo"><a href="index.php">Catálogo<span class="dot">.</span></a></div>
    <nav class="menu">
      <a href="index.php">Home</a>
      <a href="cadastro.php">Cadastrar Produto</a>
      <a href="admin.php">Administração</a>
    </nav>
  </div>
</header>
<main class="container conteudo">
