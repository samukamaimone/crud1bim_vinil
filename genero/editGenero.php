<?php
    require_once '../scripts/init.php';

    $id = $_POST['id'];
    $nome_genero = $_POST['nome_genero'];
    $corredor = $_POST['corredor'];

    $PDO = db_connect();
    $sql = "UPDATE genero SET nome_genero = :nome_genero, corredor = :corredor WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome_genero', $nome_genero);
    $stmt->bindParam(':corredor', $corredor);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: exibirGeneros.php?sucesso=3');
    } else {
        echo "Erro ao alterar";
        print_r($stmt->errorInfo());
    }
?>