<?php
  // Salvar variaveis de conecção
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site de compras";

  // Criar a conexÃ£o
$connectbd = new mysqli($servername, $username, $password, $dbname);

  // Verificar a conexÃ£o
if ($connectbd->connect_errno) {
  die("Connection failed: $connectbd->connect_error");
};

?>