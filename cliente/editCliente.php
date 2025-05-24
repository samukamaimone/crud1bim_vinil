<?php
    require_once '../scripts/init.php';

    $id = $_POST['id'];
    $nome_cliente = $_POST['nome_cliente'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];

    $PDO = db_connect();
    $sql = "UPDATE cliente SET nome_cliente = :nome_cliente, email = :email, cpf = :cpf WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome_cliente', $nome_cliente);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: exibirClientes.php?sucesso=3');
    } else {
        echo "Erro ao alterar";
        print_r($stmt->errorInfo());
    }
?>