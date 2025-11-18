<?php
require 'inc/conexao.php';
require 'inc/header.php';

$editando = false;
$produto = ['id'=>'','nome'=>'','descricao'=>'','preco'=>'','categoria_id'=>''];

// buscar categorias
$cats = $con->query("SELECT id, nome FROM categorias ORDER BY nome ASC");

// se veio id por GET, carregar produto
if (!empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $con->prepare("SELECT id, nome, descricao, preco, categoria_id FROM produtos WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res && $res->num_rows) {
        $produto = $res->fetch_assoc();
        $editando = true;
    }
}
?>

<h2><?php echo $editando ? "Editar Produto" : "Cadastrar Produto"; ?></h2>

<form id="formProduto" action="salvar.php" method="post" novalidate>
  <input type="hidden" name="id" value="<?php echo htmlspecialchars($produto['id']); ?>">

  <label>Nome do produto:
    <input type="text" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required>
  </label>

  <label>Descrição:
    <textarea name="descricao"><?php echo htmlspecialchars($produto['descricao']); ?></textarea>
  </label>

  <div class="form-row">
    <div class="form-col">
      <label>Preço:
        <input type="number" step="0.01" name="preco" value="<?php echo htmlspecialchars($produto['preco']); ?>" required>
      </label>
    </div>
    <div class="form-col">
      <label>Categoria:
        <select name="categoria_id" required>
          <option value="">Selecione</option>
          <?php while ($c = $cats->fetch_assoc()): ?>
            <option value="<?php echo $c['id']; ?>" <?php echo ($c['id']==$produto['categoria_id']) ? 'selected':''; ?>>
              <?php echo htmlspecialchars($c['nome']); ?>
            </option>
          <?php endwhile; ?>
        </select>
      </label>
    </div>
  </div>

  <div class="actions">
    <button class="button" type="submit"><?php echo $editando ? "Salvar Alterações" : "Cadastrar"; ?></button>
    <a class="button secondary" href="admin.php">Voltar ao Painel</a>
  </div>
</form>

<?php require 'inc/footer.php'; ?>
