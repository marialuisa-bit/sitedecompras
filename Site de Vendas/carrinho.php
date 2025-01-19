<?php 
include './conect.php';

session_start();
if((!isset ($_SESSION['idConta']) == true)){
    header('location:login.php');
    exit();
  }
$iduser = intval($_SESSION['idConta']);
if($_SESSION['tipoConta'] == "vendedor"){
  header('location:paginaVendedor.php');
    exit();
  }

if(isset($_POST["pesquisa"])){
  $valorPesquisa = $_POST["pesquisa"];
  header("Location: paginapesquisa.php?tipo=pesquisa&valor=$valorPesquisa");
  exit;
}

if(isset($_POST["idprod"])){
  $idprod = intval($_POST["idprod"]);
  $query = "DELETE FROM `carrinho` WHERE idusuario = ? AND idproduto = ? ";
  $stmt = $connectbd->prepare($query);
  $stmt->bind_param("ii", $iduser, $idprod);
  $stmt->execute();
}

if(isset($_POST["limparCarrinho"])){
  $query = "DELETE FROM `carrinho` WHERE idusuario = ?";
  $stmt = $connectbd->prepare($query);
  $stmt->bind_param("i", $iduser);
  $stmt->execute();
}
$valorTotal = 20;

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
      <div class="card" id="editor-de-conta" style="width: 13rem">
        <div class="card-header">Sua Conta</div>
        <div class="card-body">
          <h2 class="card-title">Nome</h2>
          <h3 class="card-subtitle">Tipo de conta</h3>

          <a class="btn btn-secondary" href="informacoesconta.php"
            >Inforções da conta</a
          >

          <a class="btn btn-secondary" href="login.php">Trocar de Conta</a>

          <a class="btn btn-secondary" href="home.php">sair da Conta</a>
        </div>
      </div>
    </header>
    <main>
      <div id="interface">
        <table id="carrinho">
          <tr>
            <td colspan="6">
              <h1 style="text-align: center; margin-bottom: 2rem">
                Seu Carrinho
              </h1>
            </td>
          </tr>
          <?php 
             $iduser = intval($_SESSION['idConta']);

             $query = "SELECT * FROM carrinho WHERE idusuario = ?";
             $stmt = $connectbd->prepare($query);
             $stmt->bind_param('i', $iduser);
             $stmt->execute();
             $carr = $stmt->get_result();
             $numRows = $carr->num_rows;
             
             if($numRows > 0) {
                 for($i = 1; $i <= $numRows; $i++){
                     $result = $carr->fetch_assoc();
                     $qnt = $result['qntproduto'];
                     $idprod = $result['idproduto'];

                     $query2 = "select imagem, nome, preco, descricao from produto where idproduto = ?";
                     $stmt = $connectbd->prepare($query2);
                     $stmt->bind_param('i', $idprod);
                     $stmt->execute();
                     $card = $stmt->get_result();

                     $result2 = $card->fetch_assoc();
                     $imagem = $result2["imagem"];
                     $nome = $result2["nome"];
                     $preco = $result2["preco"];
                     $descricao = $result2["descricao"];

                     $precoT = $preco * $qnt;

                     $valorTotal = $valorTotal + $precoT;
                     echo "
                     <tr>
            <td id=\"marcadorcarrinho\">
            </td>
            <td rowspan=\"2\" class=\"imgvend\">
              <div class=\"itemvend\">
                <a href=\"paginaproduto.php\"
                  ><div
                    style=\width: 10rem; height: 10rem\"
                  >
                  <img src=\"$imagem\">
                  </div
                ></a>
              </div>
            </td>
            <td colspan=\"3\" class=\"nomevend\">$nome</td>
            <td rowspan=\"2\" class=\"descricaovend\">
              <div class=\"itemvend\">
                $descricao
              </div>
            </td>
          </tr>
          <tr>
            <td class=\"excluircarrinho\">
              <div class=\"itemvend\">
                 <form method=\"POST\">
                  <input type=\"hidden\" name=\"idprod\" value=\"$idprod\">
                  <button type=\"submit\ class=\"btn btn-danger\">
                    Excluir
                  </button>
                  </form>
              </div>
            </td>
            <td class=\"precovend\">R$$precoT</td>
            <td class=\"dispvend\">Valor unit. R$$preco</td>
            <td class=\"vendidosvend\">
              <input
                class=\"form-control\"
                type=\"number\"
                value=\"1\"
                style=\"width: 70%; margin-left: 20%\"s
              />
            </td>
          </tr>";}
          echo "<tr>
            <td id=\"marcadorcarrinho\"></td>
            <td rowspan=\"2\" class=\"imgvend\"></td>
            <td colspan=\"3\" class=\"nomevend\">FRETE</td>
            <td rowspan=\"2\" class=\"descricaovend\">
              <div class=\"itemvend\">
                A compra será enviada para o endereço registrado na conta e o
                pagamento será feito pela conta registrada. Para aterações,
                modificar diretamente na conta.
              </div>
            </td>
          </tr>
          <tr>
            <td class=\"excluircarrinho\"></td>

            <td colspan=\"4\" class=\"precovend\">R$20,00</td>
          </tr>";  
          } else {
                 echo "<br><br><br>
                       <h1>Seu carrinho está vazio :(</h1>
                       <br>
                       <h2>Experimenta adicionar alguns item</h2>";
             }
             ?>
          
          
          <tr>
            <td></td>
            <td>
              <div class="form-check" id="divmarcatudo">
              </div>
            </td>
            <td colspan="2">
              <form method = "post">
                <input type="hidden" name="limparCarrinho" value="<?php echo "$iduser";?>">
                <button type="submit" class="btn btn-danger" id="limparcarrinho">
                  Limpar carrinho
                </button>
              </form>
            </td>
            <td><div id="valortotalcarrinho">Valor total: R$<?php echo "$valorTotal"; ?></div></td>
            <td style="display: inline-flex">
              <button class="btn btn-success" id="comprartudo">
                Finalizar Compra
              </button>
              <input
                type="text"
                class="form-control"
                id="cumpomdesconto"
                placeholder="Aplique um Cupom!"
              />
            </td>
          </tr>
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

