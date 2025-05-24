<?php
    require_once '../scripts/init.php';

    $nome = $_POST['nome_cliente'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];

    $PDO = db_connect();
    $sql = "INSERT INTO cliente(nome_cliente, email, cpf) VALUES (:nome, :email, :cpf)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':cpf', $cpf);

    if ($stmt->execute()) {
        header('Location: exibirClientes.php?sucesso=1');
    } else {
        echo "Erro ao cadastrar";
        print_r($stmt->errorInfo());
    }
        
?>
