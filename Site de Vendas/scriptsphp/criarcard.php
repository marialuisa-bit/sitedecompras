<?php include '../conect.php';
$card = mysqli_query($connectbd, "select imagem, nome, preco, descricao from produto");


if(mysqli_num_rows($card) > 0) {
    for($i = 1; $i <= 10; $i++){
        $result = $card->fetch_assoc();
        $imagem = $result["imagem"];
        $nome = $result["nome"];
        $preco = $result["preco"];
        $descricao = $result["descricao"];
        echo "
        <div class=\"col\">
        <div class=\"card h-100\" style=\"width: 18rem;\">
        <a href = \"paginaproduto.php\">
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