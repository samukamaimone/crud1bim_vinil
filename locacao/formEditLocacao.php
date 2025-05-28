<?php
    require '../scripts/init.php';
    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
    $PDO = db_connect();
    $sql = "SELECT L.id, L.data_hora, L.data_devolucao, C.id as id_cliente, C.nome_cliente as nome_cliente FROM locacao as L
                INNER JOIN cliente as C ON L.id_cliente = C.id WHERE L.id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!is_array($user)) {
        header('Location: exibirLocacoes.php');
        exit;
    }

    $sql_clientes = "SELECT id, nome_cliente FROM cliente ORDER BY nome_cliente ASC";
    $stmt_clientes = $PDO->query($sql_clientes);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Locação</title>
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
                <p class="h3">Editar Locação</p>
            </div>
            <form action="editLocacao.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group col-sm-6">
                    <label for="id_cliente">Cliente:</label>
                    <select class="form-select" aria-label="Selecione um gênero" name="id_cliente" required>
                        <option selected disabled></option>
                        <?php while ($cliente = $stmt_clientes->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo $cliente['id'] ?>" <?php echo ($cliente['id'] == $user['id_cliente']) ? 'selected' : '' ?>>
                                <?php echo $cliente['nome_cliente'] ?>
                            </option>
                        <?php endwhile ?>
                    </select>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="data_hora" class="col-form-label">Data e hora da locação:</label>
                        <input type="datetime-local" class="form-control" name="data_hora" value="<?php echo $user['data_hora']; ?>" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="data_devolucao" class="col-form-label">Data para devolução:</label>
                        <input type="date" class="form-control" name="data_devolucao" value="<?php echo $user['data_devolucao']; ?>" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a type="button" class="btn btn-danger" href="exibirLocacoes.php">Cancelar</a>
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