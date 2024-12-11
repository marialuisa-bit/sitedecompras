<?php include '..\conect.php'

$card = $connectbd->query("select imagem, nome, preco, descricao from produto")->fetch_assoc();

for($i = 1; $i >= 8; $i++){
    $result = $card->fetch_assoc();
    $imagem = $result["imagem"];
    $nome = $result["nome"];
    $preco = $result["preco"];
    $descricao = $result["descricao"]
   if ($i % 4 == 0){
        echo "<tr>";
    }
    echo "
    <div class=\"card\" style=\"width: 6rem;\">
    <img src=\"$imagem\" class=\"card-img-top\">
    <div class=\"card-body\">
        <h5 class=\"card-title\">$nome</h5>
        <p class=\"card-subtitle\">$preco</p>
        <p class=\"card-text\">$descricao</p>
    </div>
    </div>";
    if ($i % 4 == 0){
        echo "</tr>";
    }
}
?>