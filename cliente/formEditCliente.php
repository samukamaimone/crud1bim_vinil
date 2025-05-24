<?php
    require '../scripts/init.php';
    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
    $PDO = db_connect();
    $sql = "SELECT nome_cliente, email, cpf FROM cliente WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!is_array($user)) {
        header('Location: exibirClientes.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
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
                <p class="h3">Editar Cliente</p>
            </div>
            <form action="editCliente.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="nome_cliente" class="col-form-label">Nome:</label>
                        <input type="text" class="form-control" name="nome_cliente" value="<?php echo $user['nome_cliente']; ?>" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="cpf">CPF:</label>
                        <input type="text" class="form-control col-sm" name="cpf" value="<?php echo $user['cpf']; ?>"
                            maxlength="14" onkeypress="formatar('###.###.###-##', this)" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a type="button" class="btn btn-danger" href="exibirClientes.php">Cancelar</a>
            </form>
        </div>
    </main>
    <div class="container">
        <footer class="footer bg-light rounded">
            <p>Samuel Maimone - Todos os direitos reservados &copy</p>
        </footer>
    </div>
</body>
<script>
    function formatar(mascara, documento) {
        let i = documento.value.length;
        let saida = '#';
        let texto = mascara.substring(i);

        while (texto.substring(0, 1) !== saida && texto.length) {
            documento.value += texto.substring(0, 1);
            i++;
            texto = mascara.substring(i);
        }
    }
</script>

</html>