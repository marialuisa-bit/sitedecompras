document.getElementById("atlzprod").addEventListener("click", function (event) {
  event.preventDefault(); // Impede o envio do formulário

  let erros = []; // Array para armazenar mensagens de erro

  // Obtendo os valores dos campos
  const imgProduto = document.getElementById("atl-img-produto").files[0]; // Verifica se há arquivo
  const nomeProduto = document.getElementById("atl-nome-produto").value.trim();
  const precoProduto = document
    .getElementById("atl-preco-produto")
    .value.trim();
  const quantidadeProduto = document
    .getElementById("atl-quantidade-produto")
    .value.trim();
  const descricaoProduto = document
    .getElementById("atl-descricao-produto")
    .value.trim();

  // Verificação de imagem (se foi selecionado um arquivo)
  if (!imgProduto) {
    erros.push("A imagem do produto é obrigatória.");
  }

  // Verificação do nome do produto
  if (!nomeProduto) {
    erros.push("O nome do produto é obrigatório.");
  } else if (nomeProduto.length > 30) {
    erros.push("O nome do produto deve ter no máximo 30 caracteres.");
  }

  // Verificação do preço do produto (somente números) e preço máximo 999,99
  const regexPreco = /^\d+(\.\d{1,2})?$/; // Permite números inteiros ou decimais com até 2 casas
  if (!regexPreco.test(precoProduto)) {
    erros.push("O preço deve ser um número válido (exemplo: 100.99).");
  } else if (parseFloat(precoProduto) > 999.99) {
    erros.push("O preço não pode ser superior a 999,99.");
  }

  // Verificação da quantidade do produto (deve ser um número e maior que zero)
  if (!quantidadeProduto || quantidadeProduto <= 0) {
    erros.push(
      "A quantidade do produto deve ser um número válido maior que zero."
    );
  }

  // Verificação da descrição do produto (máximo 120 caracteres)
  if (!descricaoProduto) {
    erros.push("A descrição do produto é obrigatória.");
  } else if (descricaoProduto.length > 120) {
    erros.push("A descrição do produto deve ter no máximo 120 caracteres.");
  }

  // Exibindo as mensagens de erro
  const mensagensErro = document.getElementById("mensagensErro");
  mensagensErro.innerHTML = ""; // Limpa mensagens de erro anteriores

  if (erros.length > 0) {
    mensagensErro.innerHTML = erros.join("<br>"); // Exibe os erros
  } else {
    mensagensErro.innerHTML = "Produto atualizado com sucesso!";
    // Aqui você pode enviar o formulário ou realizar outras ações
    console.log("Formulário válido! Enviando...");

    // Se for necessário enviar o formulário, descomente a linha abaixo:
    // document.querySelector("form").submit();
  }
});
