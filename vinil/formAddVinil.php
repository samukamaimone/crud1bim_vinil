<?php
require_once '../scripts/init.php';
$PDO = db_connect();
$sql = "SELECT id, nome_genero FROM genero ORDER BY nome_genero ASC";
$stmt = $PDO->prepare($sql);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Vinis</title>
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
                <p class="h3">Cadastro de Vinis</p>
            </div>
            <form action="addVinil.php" method="post">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="titulo" class="col-form-label">Título:</label>
                        <input type="text" class="form-control" name="titulo" id="titulo" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="banda" class="col-form-label">Banda:</label>
                        <input type="text" class="form-control" name="banda" id="banda" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="id_genero">Gênero:</label>
                        <select class="form-select" aria-label="Selecione um gênero" name="id_genero" required>
                            <option selected></option>
                            <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?php echo $user['id'] ?>"><?php echo $user['nome_genero'] ?></option>
                            <?php endwhile ?>
                        </select>
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