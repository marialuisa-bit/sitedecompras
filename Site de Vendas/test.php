<?php
include './conect.php';
include './scriptsphp/funcoes.php';
session_start();


if(isset($_POST['cpf_cnpj'], $_POST['senha'])){
  $cpf_cnpjpost = $_POST['cpf_cnpj'];
  $senhapost = $_POST['senha'];

  $user = verificaExisteUser($cpf_cnpjpost);

  if($user == "não existe"){
    echo "Usuario não encontrado";
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
            exit();
          }
      } else {
          echo "senha não correspondente";
          exit();
        }

    }
}
?>



<?php
 include './conect.php';
 include './scriptsphp/funcoes.php';
 session_start();

 if(isset($_POST['nome'], $_POST['cpf'], $_POST['datanasc'], $_POST['email'], $_POST['cel'], $_POST['senha'])){
    $nomePost = $_POST['nome'];
    $cpfPost = $_POST['cpf'];
    $dataNascPost = $_POST['datanasc'];
    $emailPost = $_POST['email'];
    $celPost = $_POST['cel'];
    $senhaPost = $_POST['senha'];

    $cliente = verificaExisteCliente($cpfPost);
    if($cliente == "não exite esse cliente"){
      mysqli_query($connectbd, "INSERT INTO `usuario`(`senha`, `nome`, `telefone`, `email`) VALUES ('$senhaPost','$nomePost','$celPost','$emailPost',)");
      $last_id = mysqli_insert_id($connectbd);
      mysqli_query($connectbd, "INSERT INTO `cliente`(`idusuario`, `datanasc`, `cpf`) VALUES ('$last_id','$dataNascPost','$cpfPost')");
    }else {
      echo "CPF já cadastrado";
    } 
}

?>
