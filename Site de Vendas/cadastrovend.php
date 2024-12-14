<?php
 include './conect.php';
 include './scriptsphp/funcoes.php';
 session_start();

 if(isset($_POST['nome'], $_POST['cnpj'], $_POST['email'], $_POST['cel'], $_POST['tipo'], $_POST['senha'])){
    $nomePost = $_POST['nome'];
    $cnpjPost = $_POST['cnpj'];
    $emailPost = $_POST['email'];
    $celPost = $_POST['cel'];
    $tipoPost = $_POST['tipo'];
    $senhaPost = $_POST['senha'];

    $vendedor = verificaExisteVendedor($cnpjPost);
    if($vendedor == "não existe esse vendedor"){
      mysqli_query($connectbd, "INSERT INTO `usuario`(`senha`, `nome`, `telefone`, `email`) VALUES ('$senhaPost','$nomePost','$celPost','$emailPost')");
      $last_id = mysqli_insert_id($connectbd);
      mysqli_query($connectbd, "INSERT INTO `vendedor`(`idusuario`, `tipoconta`, `cnpj`) VALUES ('$last_id','$tipoPost','$cnpjPost')");
      echo "Cadastro realizado!!";
      header('location: login.php');
            exit();
    } else {
      $mensagemErro = "CNPJ já cadastrado";
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
    <script src="js/verificadorvend.js" defer></script>
  </head>
  <body>
    <header id="cabecalho">
      <a href="home.php"> <h1 id="titulo">Site de Compras</h1></a>
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
        <div class="card" style="width: 40%">
          <div class="card-header">Cadastro vendedor</div>
          <div class="card-body">
            <form id="formCadastro" method="post">
              <div class="form-group">
                <label for="nome-cadastro-vend">Nome da loja:</label>
                <input
                  type="text"
                  class="form-control"
                  id="nome-cadastro-vend"
                  placeholder="Nome da loja"
                  name='nome'
                  required
                />
              </div>
              <div class="form-group">
                <label for="cnpj-cadastro">CNPJ:</label>
                <input
                  type="text"
                  class="form-control"
                  id="cnpj-cadastro"
                  placeholder="CNPJ apenas números"
                  name='cnpj'
                  required
                />
              </div>
              <div class="form-group">
                <label for="cel-cadastro-vend">Celular:</label>
                <input
                  type="tel"
                  class="form-control"
                  id="cel-cadastro-vend"
                  placeholder="Celular com ddd"
                  name='cel'
                  required
                />
              </div>
              <div class="form-group">
                <label for="email-cadastro-vend">Email:</label>
                <input
                  type="email"
                  class="form-control"
                  id="email-cadastro-vend"
                  placeholder="Email"
                  name='email'
                  required
                />
              </div>
              <div class="form-group">
                <label for="tipodeprod">Tipo de produto vendido:</label>
                <select
                  class="form-select"
                  aria-label="Tipo de produto"
                  name='tipo'
                  id="tipodeprod"
                >
                  <option value="eletronicos">Eletrônicos</option>
                  <option value="papelaria">Papelaria</option>
                  <option value="roupas">Roupas</option>
                  <option value="infantil">Infantil</option>
                  <option value="diversos">Diversos</option>
                </select>
              </div>
              <div class="form-group">
                <label for="senha-cadastro-vend">Senha:</label>
                <input
                  type="password"
                  class="form-control"
                  id="senha-cadastro-vend"
                  name='senha'
                  placeholder="Senha"
                  required
                />
              </div>
              <div class="form-group">
                <label for="confirmar-senha-cadastro-vend"
                  >Confirme sua senha:</label
                >
                <input
                  type="password"
                  class="form-control"
                  id="confirmar-senha-cadastro-vend"
                  placeholder="Confirme sua senha"
                  required
                />
              </div>

              <div>
                <button
                  type="button"
                  class="btn btn-primary"
                  id="gpbtnlogincad"
                >
                  Cadastrar-se
                </button>

                <a
                  href="login.php"
                  class="btn btn-outline-primary"
                  id="gpbtnlogincad"
                >
                  Já tenho conta
                </a>
              </div>
            </form>
            <!-- Div para mostrar as mensagens de erro -->
            <div id="mensagensErro" style="color: red">
            <?php if (isset($mensagemErro)){ echo $mensagemErro;} ?> 
            </div>
          </div>
        </div>
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
      </div>
    </main>
  </body>
</html>
