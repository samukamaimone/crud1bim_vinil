<?php
    require_once '../scripts/init.php';

    $id = $_POST['id'];
    $data_hora = $_POST['data_hora'];
    $data_devolucao = $_POST['data_devolucao'];
    $id_cliente = $_POST['id_cliente'];

    $PDO = db_connect();
    $sql = "UPDATE locacao SET data_hora = :data_hora, data_devolucao = :data_devolucao, id_cliente = :id_cliente WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':data_hora', $data_hora);
    $stmt->bindParam(':data_devolucao', $data_devolucao);
    $stmt->bindParam(':id_cliente', $id_cliente);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: exibirLocacoes.php?sucesso=3');
    } else {
        echo "Erro ao alterar";
        print_r($stmt->errorInfo());
    }
?>