<?php
    require_once '../scripts/init.php';

    $titulo = $_POST['titulo'];
    $banda = $_POST['banda'];
    $id_genero = $_POST['id_genero'];

    $PDO = db_connect();
    $sql = "INSERT INTO vinil(titulo, banda, id_genero) VALUES (:titulo, :banda, :id_genero)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':banda', $banda);
    $stmt->bindParam(':id_genero', $id_genero);

    if ($stmt->execute()) {
        header('Location: exibirVinis.php?sucesso=1');
    } else {
        echo "Erro ao cadastrar";
        print_r($stmt->errorInfo());
    }
        
?>
