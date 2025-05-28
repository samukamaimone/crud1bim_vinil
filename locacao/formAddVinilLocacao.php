<?php
    require_once '../scripts/init.php';
    $PDO = db_connect();
    $id_locacao = isset($_GET['id']) ? (int) $_GET['id'] : null;
    if (!$id_locacao) {
        echo "ID da locação não informado.";
    exit;   
    }

    $sql_vinil = "SELECT id as id_vinil, titulo FROM vinil ORDER BY titulo ASC";
    $sql_locacao = "SELECT id, data_hora, data_devolucao FROM locacao";

    $stmt_vinil = $PDO->prepare($sql_vinil);
    $stmt_vinil->execute();

    $stmt_locacao = $PDO->prepare($sql_locacao);
    $stmt_locacao->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adição de Vinis</title>
    <link rel="stylesheet" href="../static/style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#menu").load("../navbar/navbar.html");
        });
    </script>
</head>

<body>
    <div class="container">
        <div id="menu"></div>
    </div>
    <main>
        <div class="container">
            <div class="jumbotron text-center">
                <p class="h3">Adição de Vinis</p>
            </div>
            <form action="addVinilLocacao.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id_locacao; ?>">
                <div class="form-group">
                    <label for="id_vinil">Vinil:</label>
                    <select class="form-select" name="id_vinil" required>
                        <option selected></option>
                        <?php while ($vinil = $stmt_vinil->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo $vinil['id_vinil'] ?>"><?php echo $vinil['titulo'] ?></option>
                        <?php endwhile ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a type="button" class="btn btn-danger" href="../locacao/exibirLocacoes.php">Cancelar</a>
            </form>
        </div>
    </main>
    <div class="container">
        <footer class="footer rounded">
            <p>Samuel Maimone - Todos os direitos reservados &copy</p>
        </footer>
    </div>
</body>

</html>