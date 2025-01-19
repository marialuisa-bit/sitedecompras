<?php
include './conect.php';
include './funcoes.php';
session_start();

if(isset($_POST['cpf_cnpj'], $_POST['senha'])){
  $cpf_cnpjpost = $_POST['cpf_cnpj'];
  $senhapost = $_POST['senha'];

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
      $senhaQuery = mysqli_query($connectbd,"select senha from usuario where idusuario = '$id'");
      $senha = mysqli_fetch_assoc($senhaQuery);

      if($senhapost == $senha['senha']){
        $_SESSION['idConta'] = $id;
        $_SESSION['tipoConta'] = $user;
        if($_SESSION['tipoConta'] == "vendedor"){
            header('location: paginaVendedor.php');
        } else {
            header('location: home.php');
        }
      } else {
          $mensagemErro = "senha não correspondente";
      }
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
      <a href="carrinho.php">
        <script src="https://cdn.lordicon.com/lordicon.js"></script>
        <lord-icon
          id="logo"
          src="https://cdn.lordicon.com/mfmkufkr.json"
          trigger="hover"
          colors="primary:#ffffff"
          style="width: 250px; height: 150px"
        >
        </lord-icon>
      </a>
    </header>
    <main>
      <div id="interface">
        <div class="card" style="width: 30%; margin-bottom: 5rem;">
          <div class="card-header">Login</div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">
                <label for="cpf-login">CPF/CNPJ:</label>
                <input
                  type="text"
                  class="form-control"
                  id="cpf-login"
                  placeholder="CPF ou CNPJ"
                  name="cpf_cnpj"
                  required
                />
              </div>
              <div class="form-group">
                <label for="senha-login">Senha:</label>
                <input
                  type="password"
                  class="form-control"
                  id="senha-login"
                  placeholder="Senha"
                  name="senha"
                  required
                />
                <a href="trocasenha.php" class="card-subtitle mb-2 text-muted" id="cadastro">Esqueci minha senha</a>
              </div>

              <div>
                <button type="submit" class="btn btn-primary" id="gpbtnlogin">Login</button>
              </div>
              <div id="mensagensErro" style="color: red">
            <?php if (isset($mensagemErro)){ echo $mensagemErro;} ?> 
            </div> <br>

              <div class="form-group" style="padding-bottom: 1px">
                <a href="cadastro.php" class="card-subtitle mb-2 text-muted" id="cadastro">Criar conta como cliente</a>
              </div>
              <div class="form-group" style="padding-bottom: 2px">
                <a href="cadastrovend.php" class="card-subtitle mb-2 text-muted" id="cadastro">Criar conta como vendedor</a>
              </div>
            </form>
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
