<?php 
include './conect.php';
session_start();

if((!isset ($_SESSION['idConta']) != true)){
  $loginSpace = "<div class=\"card\" id=\"editor-de-conta\" style=\"width: 13rem\">
  <div class=\"card-header\">Sua Conta</div>
  <div class=\"card-body\">
    <h2 class=\"card-title\">Nome</h2>
    <h3 class=\"card-subtitle\">Tipo de conta</h3>

    <a class=\"btn btn-secondary\" href=\"informacoesconta.php\"
      >Inforções da conta</a
    >

    <a class=\"btn btn-secondary\" href=\"login.php\">Trocar de Conta</a>

    <a class=\"btn btn-secondary\" href=\"home.php\">sair da Conta</a>
  </div>
</div>";
} else {
  $loginSpace = "<a href=\"login.php\" class=\"entrar\" id=\"login\"
        ><img id=\"icon-login\" src=\"img/icon.png\" alt=\"Login\"
      /></a>";
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
          <td>
            <label for="pesquisa"
              ><a href="paginapesquisa.php"
                ><lord-icon
                  id="pesquisa"
                  src="https://cdn.lordicon.com/kkvxgpti.json"
                  trigger="hover"
                  colors="primary:#ffffff"
                  style="width: 50px; height: 50px"
                >
                </lord-icon
              ></a>
              ></label
            >
          </td>
          <td>
            <input
              type="text"
              id="pesquisa"
              name="pesquisa"
              placeholder="Pesquise aqui!"
            />
          </td>
        </tr>
      </table>
      
      <?php echo "$loginSpace";?>

      <nav id="categorias">
        <ul>
          <li><a href="paginapesquisa.php" div class='btn btn-primary'>Eletronicos</a></li>
          <li><a href="paginapesquisa.php" class='btn btn-primary'>Roupas</a></li>
          <li><a href="paginapesquisa.php" class='btn btn-primary'>Papelaria</a></li>
          <li><a href="paginapesquisa.php" class='btn btn-primary'>Infantil</a></li>
          <li><a href="paginapesquisa.php" class='btn btn-primary'>Diversos</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <div id="interface">
        <section id="corpo">
          <h2 id="titulo">Produtos em destaque</h2>
          <br>
          <br>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5 g-4">

             <?php 
             $card = mysqli_query($connectbd, "select imagem, nome, preco, descricao, idproduto from produto");
             
             
             if(mysqli_num_rows($card) > 0) {
                 for($i = 1; $i <= 10; $i++){
                     $result = $card->fetch_assoc();
                     $imagem = $result["imagem"];
                     $nome = $result["nome"];
                     $preco = $result["preco"];
                     $descricao = $result["descricao"];
                     $idprod = $result["idproduto"];
                     echo "
                     <div class=\"col\">
                     <div class=\"card h-100\" style=\"width: 14rem;\">
                     <a href = \"paginaproduto.php?idprod=$idprod\">
                     <img src=\"$imagem\" class=\"card-img-top\">
                     </a>
                     <div class=\"card-body\">
                         <h5 class=\"card-title\">$nome</h5>
                         <p class=\"card-subtitle\">R$ $preco</p>
                         </br>
                         <p class=\"card-text\">$descricao</p>
                     </div>
                     </div>
                     </div>";}
             } else {
                 echo "<br><br><br>
                       <h1>Nenhum produto encontrado.</h1>
                       <br>
                       <h2>Por favor, tente novamente ou entre em contato com o suporte</h2>";
             }
             ?>

            </div>
        </section>

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
