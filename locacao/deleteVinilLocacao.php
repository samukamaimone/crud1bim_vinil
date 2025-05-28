<?php
require_once '../scripts/init.php';

$id_locacao = isset($_GET['id']) ? (int)$_GET['id'] : null;
$id_vinil = isset($_GET['id_vinil']) ? (int)$_GET['id_vinil'] : null;

if (!$id_locacao || !$id_vinil) {
    echo "Parâmetros incompletos.";
    exit;
}

$PDO = db_connect();

$sql = "DELETE FROM vinil_locacao WHERE id_locacao = :id_locacao AND id_vinil = :id_vinil";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id_locacao', $id_locacao, PDO::PARAM_INT);
$stmt->bindParam(':id_vinil', $id_vinil, PDO::PARAM_INT);

if ($stmt->execute()) {
    header("Location: exibirVinilLocacoes.php?id=$id_locacao&sucesso=2");
    exit;
} else {
    echo "Erro ao remover o vinil.";
    print_r($stmt->errorInfo());
}
?>
