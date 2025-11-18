<?php
require 'inc/conexao.php';
require 'inc/header.php';

$msg = '';
if (!empty($_GET['msg'])) {
    if ($_GET['msg'] === 'criado') $msg = 'Produto criado com sucesso.';
    if ($_GET['msg'] === 'editado') $msg = 'Produto editado com sucesso.';
    if ($_GET['msg'] === 'excluido') $msg = 'Produto excluído com sucesso.';
}

// buscar produtos
$stmt = $con->prepare("SELECT p.id, p.nome, p.preco, p.criado_em, c.nome AS categoria FROM produtos p JOIN categorias c ON p.categoria_id = c.id ORDER BY p.criado_em DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Painel Administrativo</h2>

<?php if ($msg): ?>
  <div class="msg"><?php echo htmlspecialchars($msg); ?></div>
<?php endif; ?>

<div class="table-wrap">
<table class="tabela" role="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Categoria</th>
      <th>Preço</th>
      <th>Data</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo htmlspecialchars($row['nome']); ?></td>
      <td><?php echo htmlspecialchars($row['categoria']); ?></td>
      <td>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
      <td><?php echo $row['criado_em']; ?></td>
      <td class="actions">
        <a class="edit" href="cadastro.php?id=<?php echo $row['id']; ?>">Editar</a>
        <a class="del" href="excluir.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Confirmar exclusão deste produto?')">Excluir</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
</div>

<?php require 'inc/footer.php'; ?>
