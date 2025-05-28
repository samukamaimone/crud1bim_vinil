<?php
    require_once '../scripts/init.php';

    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if(empty($id)){
        echo "ID não informado";
        exit;
    }

    $PDO = db_connect();
    $sql = "DELETE FROM genero WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    try{
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header('Location: exibirGeneros.php?sucesso=2'); // sucesso
        exit;
    }
    catch(PDOException $e){
        header('Location: exibirGeneros.php?sucesso=0');
        exit;
    }
?>