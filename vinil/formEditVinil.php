<?php
    require '../scripts/init.php';
    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
    $PDO = db_connect();
    $sql = "SELECT V.id, V.titulo, V.banda, G.id as id_genero, G.nome_genero as nome_genero FROM vinil as V 
            INNER JOIN genero as G ON V.id_genero = G.id WHERE V.id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!is_array($user)) {
        header('Location: exibirVinis.php');
        exit;
    }

    $sql_generos = "SELECT id, nome_genero FROM genero ORDER BY nome_genero ASC";
    $stmt_generos = $PDO->query($sql_generos);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vinil</title>
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
                <p class="h3">Editar Vinil</p>
            </div>
            <form action="editVinil.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="titulo" class="col-form-label">Tiítulo:</label>
                        <input type="text" class="form-control" name="titulo" value="<?php echo $user['titulo']; ?>" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="banda" class="col-form-label">Banda:</label>
                        <input type="text" class="form-control" name="banda" value="<?php echo $user['banda']; ?>" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="id_genero">Gênero:</label>
                        <select class="form-select" aria-label="Selecione um gênero" name="id_genero" required>
                            <option selected disabled></option>
                            <?php while ($genero = $stmt_generos->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?php echo $genero['id'] ?>" <?php echo ($genero['id'] == $user['id_genero']) ? 'selected' : '' ?>>
                                    <?php echo $genero['nome_genero'] ?>
                                </option>
                            <?php endwhile ?>
                        </select>
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