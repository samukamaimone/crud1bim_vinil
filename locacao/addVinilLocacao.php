<?php
require_once '../scripts/init.php';

if (!isset($_POST['id']) || !isset($_POST['id_vinil'])) {
    echo "Dados incompletos.";
    exit;
}

$id_locacao = (int)$_POST['id'];
$id_vinil = (int)$_POST['id_vinil'];

$PDO = db_connect();
$sql = "INSERT INTO vinil_locacao(id_vinil, id_locacao) VALUES (:id_vinil, :id_locacao)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id_vinil', $id_vinil, PDO::PARAM_INT);
$stmt->bindParam(':id_locacao', $id_locacao, PDO::PARAM_INT);

if ($stmt->execute()) {
    header("Location: exibirVinilLocacoes.php?sucesso=1&id=$id_locacao");
    exit;
} else {
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}
?>