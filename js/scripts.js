// js/scripts.js - validação e pequenas interações
document.addEventListener('DOMContentLoaded', function () {
  var form = document.getElementById('formProduto');
  if (!form) return;

  form.addEventListener('submit', function (e) {
    var nome = document.querySelector('input[name="nome"]').value.trim();
    var preco = document.querySelector('input[name="preco"]').value;
    var categoria = document.querySelector('select[name="categoria_id"]').value;

    var erros = [];
    if (nome === '') erros.push('O nome é obrigatório.');
    if (categoria === '') erros.push('Escolha uma categoria.');
    if (preco === '' || isNaN(parseFloat(preco)) || parseFloat(preco) < 0) erros.push('Informe um preço válido.');

    if (erros.length) {
      e.preventDefault();
      alert('Corrija os seguintes erros:\n- ' + erros.join('\n- '));
    }
  });
});
