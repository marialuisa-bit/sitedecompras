<?php
include '../conect.php';
session_start();

function verificaExisteUser($u) {
    global $connectbd; // Certifique-se de que a variável global de conexão está acessível

    // Sanitize input to prevent SQL injection
    $u = mysqli_real_escape_string($connectbd, $u);

    // Verificar se o CPF existe na tabela 'cliente'
    $consulta = mysqli_query($connectbd, "SELECT idusuario FROM cliente WHERE cpf = '$u'");
    if (!$consulta) {
        die('Erro na consulta: ' . mysqli_error($connectbd)); // Exibe erro de consulta SQL
    }

    if (mysqli_num_rows($consulta) > 0) {
        return "cliente";  // Usuário encontrado na tabela cliente
    }

    // Verificar se o CNPJ existe na tabela 'vendedor'
    $consulta = mysqli_query($connectbd, "SELECT idusuario FROM vendedor WHERE cnpj = '$u'");
    if (!$consulta) {
        die('Erro na consulta: ' . mysqli_error($connectbd)); // Exibe erro de consulta SQL
    }

    if (mysqli_num_rows($consulta) > 0) {
        return "vendedor";  // Usuário encontrado na tabela vendedor
    }

    // Se não encontrado em nenhuma das tabelas
    return "não existe";
}

function verificaExisteCliente($cpf) {
    global $connectbd;  // Não se esqueça de garantir que $connectbd está disponível dentro da função

    $consulta = mysqli_query($connectbd, "SELECT * FROM cliente WHERE cpf = '$cpf'");
    if (mysqli_num_rows($consulta) > 0) {
        return "CPF já cadastrado";
    } else {
        return "não existe esse cliente";
    }
}

function verificaExisteVendedor($cnpj) {
    global $connectbd;  // Não se esqueça de garantir que $connectbd está disponível dentro da função

    $consulta = mysqli_query($connectbd, "SELECT * FROM vendedor WHERE cnpj = '$cnpj'");
    if (mysqli_num_rows($consulta) > 0) {
        return "CNPJ já cadastrado";
    } else {
        return "não existe esse vendedor";
    }
}
?>