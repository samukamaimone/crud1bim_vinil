<?php
    require_once '../scripts/init.php';
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
    if (empty($titulo)){
        header('Location: ../msg/msgErro.html');
    }
    
    $pesquisa = '%' . $titulo . '%';
    $PDO = db_connect();
    $sql = "SELECT V.id, V.titulo, V.banda, V.id_genero, G.nome_genero as nome_genero FROM vinil as V 
    INNER JOIN genero as G on V.id_genero = G.id WHERE upper(titulo) like :titulo ORDER BY V.id ASC";
    $stmt = $PDO->prepare($sql);
    $stmt->execute([':titulo' => $pesquisa]);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa de Vinis</title>
    <link rel="stylesheet" href="../static/style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
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
          <p class="h3">Resultado da Pesquisa</p>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Código</th>
              <th>Título do vinil:</th>
              <th>Banda:</th>
              <th>Gênero:</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
              <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['titulo']; ?></td>
                <td><?php echo $user['banda']; ?></td>
                <td><?php echo $user['nome_genero']; ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <a class="btn btn-primary" href="pesquisarVinil.html">Nova Pesquisa</a>
        </div>
    </main>
    <div class="container">
        <footer class="footer rounded">
            <p>Samuel Maimone - Todos os direitos reservados &copy</p>
        </footer>
    </div>
</body>

</html>