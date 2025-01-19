<?php 
include './conect.php';

session_start();

if(isset ($_SESSION['idConta'])){
  $loginSpace = "<div class=\"card\" id=\"editor-de-conta\" style=\"width: 13rem\">
  <div class=\"card-header\">Sua Conta</div>
  <div class=\"card-body\">
    <h2 class=\"card-title\">Nome</h2>
    <h3 class=\"card-subtitle\">Tipo de conta</h3>

    <a class=\"btn btn-secondary\" href=\"informacoesconta.php\"
      >Inforções da conta</a
    >

    <a class=\"btn btn-secondary\" href=\"login.php\">Trocar de Conta</a>

    <form action=\"logout.php\">
    <button class=\"btn btn-secondary\" type=\"submit\" style=\"font-size:13px;margin-top:4px;\">sair da Conta</button>
    </form>
  </div>
</div>";
} else {
  $loginSpace = "<a href=\"login.php\" class=\"entrar\" id=\"login\"
        ><img id=\"icon-login\" src=\"img/icon.png\" alt=\"Login\"
      /></a>";
}

if(isset($_POST["pesquisa"])){
  $valorPesquisa = $_POST["pesquisa"];
  header("Location: paginapesquisa.php?tipo=pesquisa&valor=$valorPesquisa");
  exit;
}

$idprod = $_GET["idprod"];
$prod = mysqli_query($connectbd, "select imagem, nome, preco, descricao, qntestoque from produto where idproduto = $idprod");
$prod = mysqli_fetch_assoc($prod);
$imagem = $prod["imagem"];
$nome = $prod["nome"];
$preco = $prod["preco"];
$descricao = $prod["descricao"];
$qntestoque = $prod["qntestoque"];

//script para adicionar ao carrinho
if (isset($_POST['idprod'], $_POST['tipo'])) {
  $iduser = $_SESSION['idConta'];
  $idprod = $_POST['idprod'];
  $iduser = intval($iduser);
  $idprod = intval($idprod);


  // Verifica se o produto já está no carrinho
  $query = "SELECT * FROM carrinho WHERE idusuario = ? AND idproduto = ?";
  $stmt = $connectbd->prepare($query);
  $stmt->bind_param('ii', $iduser, $idprod);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      // Se o produto já estiver no carrinho, apenas vai
      header('location: carrinho.php');
      exit;
  } else {
      // Se o produto não estiver no carrinho, insere no banco de dados
      $query = "INSERT INTO carrinho (idusuario, idproduto, qntproduto) VALUES (?, ?, ?)";
      $stmt = $connectbd->prepare($query);
      $qnt = 1;
      $stmt->bind_param('iii', $iduser, $idprod, $qnt);
      $stmt->execute();
      header('location: carrinho.php');
      exit;
  }
} elseif (isset($_POST['idprod'])){
  $iduser = $_SESSION['idConta'];
  $idprod = $_POST['idprod'];
  $iduser = intval($iduser);
  $idprod = intval($idprod);


  // Verifica se o produto já está no carrinho
  $query = "SELECT * FROM carrinho WHERE idusuario = ? AND idproduto = ?";
  $stmt = $connectbd->prepare($query);
  $stmt->bind_param('ii', $iduser, $idprod);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      // Se o produto já estiver no carrinho, faz nada
  } else {
      // Se o produto não estiver no carrinho, insere no banco de dados
      $query = "INSERT INTO carrinho (idusuario, idproduto, qntproduto) VALUES (?, ?, ?)";
      $stmt = $connectbd->prepare($query);
      $qnt = 1;
      $stmt->bind_param('iii', $iduser, $idprod, $qnt);
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
      <table id="busca">
        <tr>
          <form method = "post">
          <td>
            <label for="pesquisa"
              ><button type="submit" style="background-color: transparent;">
                <lord-icon
                  id="pesquisa"
                  src="https://cdn.lordicon.com/kkvxgpti.json"
                  trigger="hover"
                  colors="primary:#ffffff"
                  style="width: 50px; height: 50px"
                >
                </lord-icon>
              </button>
              </label
            >
          </td>
          <td>
            <input
              type="text"
              id="pesquisa"
              name="pesquisa"
              placeholder="Pesquise aqui!"
              required
            />
          </td>
          </form>
        </tr>
      </table>
      <nav id="categorias">
      <ul>
          <li><a href="paginapesquisa.php?tipo=vendedor&valor=eletronicos" div class='btn btn-primary'>Eletronicos</a></li>
          <li><a href="paginapesquisa.php?tipo=vendedor&valor=roupas" class='btn btn-primary'>Roupas</a></li>
          <li><a href="paginapesquisa.php?tipo=vendedor&valor=papelaria" class='btn btn-primary'>Papelaria</a></li>
          <li><a href="paginapesquisa.php?tipo=vendedor&valor=infantil" class='btn btn-primary'>Infantil</a></li>
          <li><a href="paginapesquisa.php?tipo=vendedor&valor=diversos" class='btn btn-primary'>Diversos</a></li>
        </ul>
      </nav>
      <?php echo "$loginSpace";?>
    </header>
    <main>
      <div id="interface">
        <table id="pagprod">
          <?php
          if(isset($_GET['idprod'])){
            if((!isset ($_SESSION['idConta']) != true)){
              echo
              "<tr>
                <td
                  rowspan=\"5\"
                  id=\"img-pagprod\"
                >
                <img src=\"$imagem\" style=\"width=10rem;\"></td>
                <td id=\"nome-pagprod\">$nome</td>
              </tr>
              <tr>
                <td id=\"preco-pagprod\">R$$preco</td>
              </tr>
              <tr>
                <td>
                <form method=\"POST\">
                  <input type=\"hidden\" name=\"idprod\" value=\"$idprod\">
                  <button type=\"submit\"id=\"butaocarrinho-pagprod\" class=\"btn btn-primary\">
                    Adicionar ao Carrinho
                  </button>
                  </form>
                </td>
              </tr>
              <tr>
                <td>
                  <form method=\"POST\">
                  <input type=\"hidden\" name=\"idprod\" value=\"$idprod\">
                  <input type=\"hidden\" name=\"tipo\" value=\"comprarAgora\">
                  <button type=\"submit\" id=\"butaocomprar-pagprod\" class=\"btn btn-secondary\">
                    Comprar agora
                  </button>
                  </form>
                </td>
              </tr>
              <tr>
                <td id=\"quant-pagprod\"><div>$qntestoque Disponíveis</div></td>
              </tr>
              <tr>
                <td colspan=\"2\" id=\"descricao-pagprod\">
                  <div>
                    $descricao
                  </div>
                </td>
              </tr>";}
              
             else {
              echo
              "<tr>
                <td
                  rowspan=\"5\"
                  id=\"img-pagprod\"
                >
                <img src=\"$imagem\" style=\"width=10rem;\"></td>
                <td id=\"nome-pagprod\">$nome</td>
              </tr>
              <tr>
                <td id=\"preco-pagprod\">R$$preco</td>
              </tr>
              <tr>
                <td>
                  Você precisa estar logado como cliente para poder comprar um produto!
                </td>
              </tr>
              <tr>
                <td>
                  <a href=\"login.php\" id=\"butaocomprar-pagprod\" class=\"btn btn-primary\">
                    Login
                  </a>
                </td>
              </tr>
              <tr>
                <td id=\"quant-pagprod\"><div>$qntestoque Disponíveis</div></td>
              </tr>
              <tr>
                <td colspan=\"2\" id=\"descricao-pagprod\">
                  <div>
                    $descricao
                  </div>
                </td>
              </tr>";}}
          else{
            echo "produto não encontrado";
          }
          ?>
        </table>
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
