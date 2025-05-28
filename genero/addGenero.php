<?php
    require_once '../scripts/init.php';

    $nome_genero = $_POST['nome_genero'];
    $corredor = $_POST['corredor'];

    $PDO = db_connect();
    $sql = "INSERT INTO genero(nome_genero, corredor) VALUES (:nome_genero, :corredor)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome_genero', $nome_genero);
    $stmt->bindParam(':corredor', $corredor);

    if ($stmt->execute()) {
        header('Location: exibirGeneros.php?sucesso=1');
    } else {
        echo "Erro ao cadastrar";
        print_r($stmt->errorInfo());
    }
        
?>
