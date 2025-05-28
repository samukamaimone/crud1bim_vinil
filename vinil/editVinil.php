<?php
    require_once '../scripts/init.php';

    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $banda = $_POST['banda'];
    $id_genero = $_POST['id_genero'];

    $PDO = db_connect();
    $sql = "UPDATE vinil SET titulo = :titulo, banda = :banda, id_genero = :id_genero WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':banda', $banda);
    $stmt->bindParam(':id_genero', $id_genero);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: exibirVinis.php?sucesso=3');
    } else {
        echo "Erro ao alterar";
        print_r($stmt->errorInfo());
    }
?>