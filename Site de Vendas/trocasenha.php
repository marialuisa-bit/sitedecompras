<?php 
include './conect.php';
include './funcoes.php';
session_start();

if(isset($_POST['cpf'], $_POST['novaSenha'])){
  $cpf_cnpjpost = $_POST['cpf'];
  $senhapost = $_POST['novaSenha'];

  $user = verificaExisteUser($cpf_cnpjpost);
  if($user == "não existe"){
    $mensagemErro = "Usuario não encontrado";
  } else {
      if($user == "vendedor"){

        $idContaQuery = mysqli_query($connectbd,"select idusuario from vendedor where cnpj = '$cpf_cnpjpost'");
        $idConta = mysqli_fetch_assoc($idContaQuery);
      } else {
          $idContaQuery = mysqli_query($connectbd,"select idusuario from cliente where cpf = '$cpf_cnpjpost'");
          $idConta = mysqli_fetch_assoc($idContaQuery);
        }
      $id = $idConta['idusuario'];

      $query = "UPDATE `usuario` SET senha =? WHERE idusuario = ?";
      $stmt = $connectbd->prepare($query);
      $stmt->bind_param("ii", $senhapost, $id);
      $stmt->execute();
      
}
}
?>


<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>home</title>

    <link rel="stylesheet" type="text/css" href="estilo.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <header id="cabecalho">
      <a href="home.php">
      <h1 id="titulo">Site de Compras</h1></a>
    </header>
    <main>
      <div id="interface">
        <div class="card" style="width: 30%">
          <div class="card-header">Trocar senha</div>
          <div class="card-body">
            <form method = "post" id="form-trocar-senha">
              <div class="form-group">
                <label for="cpf-login">CPF/CNPJ:</label>
                <input
                  type="text"
                  class="form-control"
                  id="cpf-login"
                  nome = "cpf"
                  placeholder="CPF ou CNPJ"
                  required
                />
              </div>
              <div class="form-group">
                <label for="senha-login">Nova senha:</label>
                <input
                  type="password"
                  class="form-control"
                  id="senha-login"
                  name = "novaSenha"
                  placeholder="nova senha"
                  required
                />
              </div>
              <div class="form-group">
                <label for="conf-senha-login">Confirme nova senha:</label>
                <input
                  type="password"
                  class="form-control"
                  id="conf-senha-login"
                  placeholder="confirme nova senha"
                  required
                />
              </div>

              <div>
                <button type="submit" class="btn btn-primary" id="gpbtnlogin">
                  Trocar senha e ir para login
                </button>
              </div>
            </form>
  <script>
  document.getElementById("form-trocar-senha").addEventListener("submit", function(event) {
    event.preventDefault();

    const cpfCnpj = document.getElementById("cpf-login").value;
    const senha = document.getElementById("senha-login").value;
    const confSenha = document.getElementById("conf-senha-login").value;

    if (senha != confSenha) {
      alert("As senhas não coincidem.");
      return;
    } else{
    this.submit(); // Envia o formulário
  }});
</script>
          </div>
        </div>
        </div>
    </main>
        <footer id="rodape">
          <p>
            Copyright &copy; 2024 - por Gustavo Beirão e Maria Luisa Gomes<br />
            <a href="https://www.instagram.com" target="_blank"
              ><script src="https://cdn.lordicon.com/lordicon.js"></script>
              <lord-icon
                src="https://cdn.lordicon.com/ewswvzmw.json"
                trigger="hover"
                stroke="bold"
                colors="primary:#ffffff,secondary:#ffffff"
                style="width: 40px; height: 40px"
              >
              </lord-icon
            ></a>

            <a href="https://whatsapp.com" target="_blank"
              ><script src="https://cdn.lordicon.com/lordicon.js"></script>
              <lord-icon
                id="redessociais"
                src="https://cdn.lordicon.com/dnphlhar.json"
                trigger="hover"
                stroke="bold"
                colors="primary:#ffffff,secondary:#ffffff"
                style="width: 40px; height: 40px"
              >
              </lord-icon
            ></a>
          </p>
        </footer>
  </body>
</html>