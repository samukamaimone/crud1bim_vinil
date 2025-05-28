<?php
require_once '../scripts/init.php';
$PDO = db_connect();
$sql = "SELECT id, nome_cliente FROM cliente ORDER BY nome_cliente ASC";
$stmt = $PDO->prepare($sql);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Locações</title>
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
                <p class="h3">Cadastro de Locações</p>
            </div>
            <form action="addLocacao.php" method="post">
                <div class="form-group col-sm-6">
                    <label for="id_cliente">Cliente:</label>
                    <select class="form-select" name="id_cliente" required>
                        <option selected></option>
                        <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo $user['id'] ?>"><?php echo $user['nome_cliente'] ?></option>
                        <?php endwhile ?>
                    </select>
                </div>
                <div class="container row">
                    <div class="form-group col-sm-6">
                        <label for="data_hora" class="col-form-label">Data e Hora da locação:</label>
                        <input type="datetime-local" class="form-control" name="data_hora" id="data_hora" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="data_devolucao" class="col-form-label">Data para devolução:</label>
                        <input type="date" class="form-control" name="data_devolucao" id="data_devolucao" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a type="button" class="btn btn-danger" href="../index.html">Cancelar</a>
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