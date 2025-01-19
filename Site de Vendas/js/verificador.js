console.log("Script carregado!");

// Função que valida o CPF
function validarCPF(cpf) {
  const regexCPF = /^[0-9]{11}$/; // 11 dígitos, apenas números
  return regexCPF.test(cpf);
}

// Função que valida o formato do celular brasileiro
function validarCelular(celular) {
  const regex = /^[0-9]{1112}$/; // 11 dígitos, apenas números
  return regex.test(celular);
}

// Função que valida o email
function validarEmail(email) {
  const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
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
    const nome = document.getElementById("nome-cadastro").value.trim();
    const cpf = document.getElementById("cpf-cadastro").value.trim();
    const dataNasc = document.getElementById("datanasc-cadastro").value;
    const celular = document.getElementById("cel-cadastro").value.trim();
    const email = document.getElementById("email-cadastro").value.trim();
    const senha = document.getElementById("senha-cadastro").value;
    const confirmarSenha = document.getElementById(
      "confirmar-senha-cadastro"
    ).value;

    // Verificações
    if (!nome) erros.push("O nome completo é obrigatório.");
    if (!validarCPF(cpf))
      erros.push("O CPF informado é inválido. Informe apenas números");
    if (!dataNasc) erros.push("A data de nascimento é obrigatória.");
    if (!validarCelular(celular))
      erros.push("O número de celular é inválido. Use apenas números.");
    if (!validarEmail(email)) erros.push("O email informado é inválido.");
    if (!validarSenha(senha))
      erros.push("A senha deve ter pelo menos 6 caracteres.");
    if (senha !== confirmarSenha) erros.push("As senhas não coincidem.");

    // Exibir erros ou sucesso
    const mensagensErro = document.getElementById("mensagensErro");
    mensagensErro.innerHTML = ""; // Limpa mensagens de erro anteriores

    if (erros.length > 0) {
      mensagensErro.innerHTML = erros.join("<br>");
    } else {
      mensagensErro.innerHTML = "Cadastro realizado com sucesso!";
      // Aqui você pode enviar o formulário, se necessário
      console.log("Formulário válido! Enviando...");

      // Envia o formulário manualmente
      document.getElementById("formCadastro").submit();
    }
  });
