<?php
  // Salvar variaveis de conexão
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site_de_vendas";

$connectbd = new mysqli($servername, $username, $password, $dbname);

if ($connectbd->connect_error) {
    die("Connection failed: " . $connectbd->connect_error);
}
?>
