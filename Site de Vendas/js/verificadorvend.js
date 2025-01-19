console.log("Script carregado!");

// Função para validar CNPJ
function validarCNPJ(cnpj) {
  const regexCNPJ = /^[0-9]{14}$/; // 14 dígitos, apenas números
  return regexCNPJ.test(cnpj);
}

// Função que valida o formato do celular brasileiro
function validarCelular(celular) {
  const regex = /^[0-9]{11,12}$/; // 11 dígitos, apenas números
  return regex.test(celular);
}

// Função que valida o email
function validarEmail(email) {
  const regex = /^[a-zA-Z0-9._-]+@[a-zAZ0-9.-]+\.[a-zA-Z]{2,6}$/;
  return regex.test(email);
}

// Função que valida a senha
function validarSenha(senha) {
  return senha.length >= 6;
}

// Função que valida o formulário
document
  .getElementById("gpbtnlogincad")
  .addEventListener("click", function (event) {
    // Impede que o formulário seja enviado imediatamente
    event.preventDefault();

    console.log("Botão clicado"); // Verifique se está entrando aqui

    let erros = [];

    // Obtendo os valores dos campos
    const nome = document.getElementById("nome-cadastro-vend").value.trim();
    const cnpj = document.getElementById("cnpj-cadastro").value.trim();
    const celular = document.getElementById("cel-cadastro-vend").value.trim();
    const email = document.getElementById("email-cadastro-vend").value.trim();
    const tipoProduto = document.getElementById("tipodeprod").value;
    const senha = document.getElementById("senha-cadastro-vend").value;
    const confirmarSenha = document.getElementById(
      "confirmar-senha-cadastro-vend"
    ).value;

    // Verificações
    if (!nome) erros.push("O nome da loja é obrigatório.");
    if (!validarCNPJ(cnpj))
      erros.push("O CNPJ informado é inválido. Informe apenas númerios.");
    if (!validarCelular(celular))
      erros.push("O número de celular é inválido. Use apenas números.");
    if (!validarEmail(email)) erros.push("O email informado é inválido.");
    if (!senha || senha.length < 6)
      erros.push("A senha deve ter pelo menos 6 caracteres.");
    if (senha !== confirmarSenha) erros.push("As senhas não coincidem.");

    // Exibir erros ou sucesso
    const mensagensErro = document.getElementById("mensagensErro");
    mensagensErro.innerHTML = ""; // Limpa mensagens de erro anteriores

    if (erros.length > 0) {
      mensagensErro.innerHTML = erros.join("<br>");
    } else {
      mensagensErro.innerHTML = "Cadastro realizado com sucesso!";
      console.log("Formulário válido! Enviando...");

      // Envia o formulário manualmente
      document.getElementById("formCadastro").submit();
    }
  });
