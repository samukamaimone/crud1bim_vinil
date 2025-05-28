<?php
    require '../scripts/init.php';
    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
    $PDO = db_connect();
    $sql = "SELECT nome_genero, corredor FROM genero WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!is_array($user)) {
        header('Location: exibirGeneros.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Gênero</title>
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
                <p class="h3">Editar Gênero</p>
            </div>
            <form action="editGenero.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="nome_genero" class="col-form-label">Nome do gênero musical:</label>
                        <input type="text" class="form-control" name="nome_genero" value="<?php echo $user['nome_genero']; ?>" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="corredor" class="col-form-label">Localização (corredor):</label>
                        <input type="text" class="form-control" name="corredor" value="<?php echo $user['corredor']; ?>" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a type="button" class="btn btn-danger" href="exibirGeneros.php">Cancelar</a>
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