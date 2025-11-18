<?php
require 'inc/conexao.php';
require 'inc/header.php';

// Buscar produtos com join
$stmt = $con->prepare("SELECT p.id, p.nome, p.descricao, p.preco, p.criado_em, c.nome AS categoria
                       FROM produtos p
                       JOIN categorias c ON p.categoria_id = c.id
                       ORDER BY p.criado_em DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Produtos Disponíveis</h2>

<div class="grid">
  <?php while ($row = $result->fetch_assoc()): ?>
    <article class="card">
      <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
      <div class="categoria"><?php echo htmlspecialchars($row['categoria']); ?></div>
      <p><?php echo nl2br(htmlspecialchars($row['descricao'])); ?></p>
      <div class="preco">R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></div>
    </article>
  <?php endwhile; ?>
</div>

<?php require 'inc/footer.php'; ?>
