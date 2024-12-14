<?php 
include './conect.php';

session_start();
if((!isset ($_SESSION['idConta']) == true)){
    header('location:login.php');
    exit();
  }
if($_SESSION['tipoConta'] == "cliente"){
  header('location:home.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Editar produto</title>

    <link rel="stylesheet" type="text/css" href="estilo.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <script src="js/verifeditprod.js" defer></script>
  </head>
  <body>
    <header id="cabecalho">
      <a href="paginaVendedor.php">
        <h1 id="titulo">Site de Compras</h1>
      </a>

      <script src="https://cdn.lordicon.com/lordicon.js"></script>
      <lord-icon
        id="logo"
        src="https://cdn.lordicon.com/mfmkufkr.json"
        trigger="hover"
        colors="primary:#ffffff"
        style="width: 250px; height: 150px"
      >
      </lord-icon>
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
      <nav id="categorias">
        <ul>
          <li>
            <a href="paginapesquisa.php" div class="btn btn-primary"
              >Eletronicos</a
            >
          </li>
          <li>
            <a href="paginapesquisa.php" class="btn btn-primary">Roupas</a>
          </li>
          <li>
            <a href="paginapesquisa.php" class="btn btn-primary">Papelaria</a>
          </li>
          <li>
            <a href="paginapesquisa.php" class="btn btn-primary">Infantil</a>
          </li>
          <li>
            <a href="paginapesquisa.php" class="btn btn-primary">Diversos</a>
          </li>
        </ul>
      </nav>
    </header>
    <main>
      <div id="interface">
        <table id="pagvend">
          <tr>
            <td colspan="5">
              <h1 style="text-align: center; margin-bottom: 2rem">
                Edite seu produto
              </h1>
            </td>
          </tr>
          <tr>
            <td rowspan="2" class="imgvend">
              <div class="itemvend">
                <a href="paginaproduto.php"
                  ><div
                    style="background-color: black; width: 10rem; height: 10rem"
                  ></div
                ></a>
              </div>
            </td>
            <td colspan="3" class="nomevend">Nome do produto</td>
            <td rowspan="2" class="descricaovend">
              <div class="itemvend">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt utLorem ipsum dolor sit amet,
                consectetur adipiscing elit, sed do eiusmod tempor incididunt
                utLorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                do eiusmod tempor incididunt ut
              </div>
            </td>
          </tr>
          <tr>
            <td class="precovend">R$1400, 00</td>
            <td class="dispvend">576 disponiveis</td>
            <td class="vendidosvend">2760 vendidos</td>
          </tr>
          <tr>
            <td colspan="5" id="cadastrodeprodutos">
              <div class="card" style="width: 80%">
                <div class="card-header">Edite seu produto</div>
                <div class="card-body">
                  <form action="">
                    <div class="form-group">
                      <label for="atl-img-produto">Imagens do produto:</label>
                      <input
                        type="file"
                        class="form-control"
                        id="atl-img-produto"
                        value=""
                        required
                      />
                    </div>
                    <div class="form-group">
                      <label for="atl-nome-produto">Nome do produto:</label>
                      <input
                        type="text"
                        class="form-control"
                        id="atl-nome-produto"
                        placeholder="Nome do produto"
                        value=""
                        required
                      />
                    </div>
                    <div class="form-group">
                      <label for="atl-preco-produto">Preço:</label>
                      <input
                        type="text"
                        class="form-control"
                        id="atl-preco-produto"
                        placeholder="Preço (apenas números)"
                        required
                      />
                    </div>
                    <div class="form-group">
                      <label for="atl-quantidade-produto"
                        >Atualização de quantidade:</label
                      >
                      <input
                        type="number"
                        class="form-control"
                        id="atl-quantidade-produto"
                        placeholder="Quantidade disponivel do produto"
                        value=""
                        required
                      />
                    </div>
                    <div class="form-group">
                      <label for="atl-descricao-produto"
                        >Descrição do produto:</label
                      >
                      <textarea
                        class="form-control"
                        id="atl-descricao-produto"
                        placeholder="Descrição"
                        rows="3"
                        required
                      ></textarea>
                    </div>

                    <div
                      style="
                        display: flex;
                        justify-content: space-around;
                        margin-top: 5px;
                      "
                    >
                      <button
                        type="button"
                        class="btn btn-primary"
                        id="atlzprod"
                      >
                        Atualizar produto
                      </button>
                      <button
                        type="button"
                        class="btn btn-danger"
                        id="excluirprod"
                      >
                        Excluir protudo
                      </button>
                    </div>
                  </form>
                  <div id="mensagensErro" style="color: red"></div>
                </div>
              </div>
            </td>
          </tr>
        </table>

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
