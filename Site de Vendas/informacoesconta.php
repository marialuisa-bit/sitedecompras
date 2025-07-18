<?php 
include './conect.php';

session_start();
if((!isset ($_SESSION['idConta']) == true)){
    header('location:login.php');
    exit();
  }

if(isset($_POST["pesquisa"])){
  $valorPesquisa = $_POST["pesquisa"];
  header("Location: paginapesquisa.php?tipo=pesquisa&valor=$valorPesquisa");
  exit;
}

if($_SESSION["tipoConta"] == "cliente") {
  $iduser = $_SESSION['idConta'];
  $infoUser = mysqli_query($connectbd, "select * from usuario where idusuario = $iduser")->fetch_assoc();
  $infoCli = mysqli_query($connectbd, "select * from cliente where idusuario = $iduser")->fetch_assoc();

  $nome = $infoUser["nome"];
  $cpf = $infoCli["cpf"];
  $dataNasc = $infoCli["datanasc"]
  $tel = $infoUser["telefone"];
  $tipo = $_SESSION["tipoConta"];
  $rua = $infoUser["rua"];
  $num = $infoUser["numero"];
  $complemento = $infoUser["complemento"];
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
        <script src="https://cdn.lordicon.com/lordicon.js"></script>
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
          <li><a href="paginapesquisa.php?tipo=vendedor&valor=eletronicos" div class='btn btn-primary'>Eletronicos</a></li>
          <li><a href="paginapesquisa.php?tipo=vendedor&valor=roupas" class='btn btn-primary'>Roupas</a></li>
          <li><a href="paginapesquisa.php?tipo=vendedor&valor=papelaria" class='btn btn-primary'>Papelaria</a></li>
          <li><a href="paginapesquisa.php?tipo=vendedor&valor=infantil" class='btn btn-primary'>Infantil</a></li>
          <li><a href="paginapesquisa.php?tipo=vendedor&valor=diversos" class='btn btn-primary'>Diversos</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <div id="interface">
        <table id="pagvend">
          <tr>
            <td colspan="5">
              <h1 style="text-align: center; margin-bottom: 2rem">Sua conta</h1>
            </td>
          </tr>
          <tr>
            <td colspan="5" id="informacoesconta">
              <div class="card" style="width: 80%">
                <div class="card-header">Suas informações</div>
                <div class="card-body">
                  <form action="">
                    <div class="form-group row">
                      <label for="nome-infconta" class="col-sm-3 col-form-label"
                        >Nome completo:</label
                      >
                      <div class="col sm-10">
                        <input
                          type="text"
                          class="form-control"
                          id="nome-infconta"
                          placeholder="Nome completo"
                          value=""
                          required
                        />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="cpf-infconta" class="col-sm-3 col-form-label"
                        >CPF/CNPJ:</label
                      >
                      <div class="col sm-10">
                        <input
                          type="text"
                          class="form-control"
                          id="cpf-infconta"
                          placeholder="CPF/CNPJ"
                          value=""
                          required
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="datanasc-infconta"
                        class="col-sm-3 col-form-label"
                        >Data de nascimento:</label
                      >
                      <div class="col sm-10">
                        <input
                          type="date"
                          class="form-control"
                          id="datanasc-infconta"
                          value="yyyy-mm-dd"
                          required
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="email-infconta"
                        class="col-sm-3 col-form-label"
                        >Email:</label
                      >
                      <div class="col sm-10">
                        <input
                          type="email"
                          class="form-control"
                          id="email-infconta"
                          placeholder="Email"
                          value=""
                          required
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="cel-infconta"
                        class="col-sm-3 col-form-label"
                        >Cel:</label
                      >
                      <div class="col sm-10">
                        <input
                          type="tel"
                          class="form-control"
                          id="cel-infconta"
                          placeholder="Celular"
                          value=""
                          required
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="tipodeconta-infconta"
                        class="col-sm-3 col-form-label"
                        >Tipo de Conta:</label
                      >
                      <div class="col sm-10">
                        <p id="tipoconta-infconta">Tipo de produto vendido ou cliente</p>
                      </div>
                    </div>

                    <hr />
                    <div class="card-title" style="font-size: 1.5rem">
                      Endereço
                    </div>
                    <div class="form-group">
                      <label for="rua-infconta">Rua e número</label>
                      <input
                        type="text"
                        class="form-control"
                        id="rua-infconta"
                        placeholder="Rua, número"
                        value=""
                      />
                    </div>
                    <div class="form-group">
                      <label for="complemento-infconta">complemento</label>
                      <input
                        type="text"
                        class="form-control"
                        id="complemento-infconta"
                        placeholder="complemento"
                        value=""
                      />
                    </div>
                    <div class="form-group">
                      <label for="cep-infconta">CEP</label>
                      <input
                        type="text"
                        class="form-control"
                        id="cep-infconta"
                        placeholder="cep"
                        value=""
                      />
                    </div>
                    <div class="form-group">
                      <label for="bairro-infconta">bairro</label>
                      <input
                        type="text"
                        class="form-control"
                        id="bairro-infconta"
                        placeholder="bairro"
                        value=""
                      />
                    </div>
                    <div class="form-group">
                      <label for="cidade-infconta"> Cidade</label>
                      <input
                        type="text"
                        class="form-control"
                        id="cidade-infconta"
                        placeholder="cidade"
                        value=""
                      />
                    </div>
                    <div class="form-group">
                      <label for="estado-infconta">Estado</label>
                      <input
                        type="text"
                        class="form-control"
                        id="estado-infconta"
                        placeholder="estado"
                        value=""
                      />
                    </div>

                    <hr />
                    <div class="card-title" style="font-size: 1.5rem">
                      Conta bancaria
                    </div>
                    <div class="form-group">
                      <label for="numconta-infconta">Número da conta:</label>
                      <input
                        type="text"
                        class="form-control"
                        id="numconta-infconta"
                        placeholder="Número da conta"
                        value=""
                      />
                    </div>
                    <div class="form-group">
                      <label for="codbanco-infconta">Código do banco:</label>
                      <input
                        type="text"
                        class="form-control"
                        id="codbanco-infconta"
                        placeholder="Código do banco"
                        value=""
                      />
                    </div>
                    <div class="form-group">
                      <label for="agenciabanco-infconta">Agência:</label>
                      <input
                        type="text"
                        class="form-control"
                        id="agenciabanco-infcont"
                        placeholder="Agência"
                        value=""
                      />
                    </div>

                    <hr />
                    <div>
                      <button
                        type="submit"
                        class="btn btn-primary"
                        id="btninfconta"
                      >
                        Salvar informações
                      </button>
                      <button
                        type="submit"
                        class="btn btn-danger"
                        id="btninfconta"
                      >
                        Excluir conta
                      </button>
                    </div>
                  </form>
                </div>
              </div>
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