<?php
    require_once '../scripts/init.php';

    $data_hora = $_POST['data_hora'];
    $data_devolucao = $_POST['data_devolucao'];
    $id_cliente = $_POST['id_cliente'];

    $PDO = db_connect();
    $sql = "INSERT INTO locacao(data_hora, data_devolucao, id_cliente) VALUES (:data_hora, :data_devolucao, :id_cliente)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':data_hora', $data_hora);
    $stmt->bindParam(':data_devolucao', $data_devolucao);
    $stmt->bindParam(':id_cliente', $id_cliente);

    if ($stmt->execute()) {
        header('Location: exibirLocacoes.php?sucesso=1');
    } else {
        echo "Erro ao cadastrar";
        print_r($stmt->errorInfo());
    }
?>
