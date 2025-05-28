<?php
    require_once '../scripts/init.php';
    $nome_cliente = isset($_POST['nome_cliente']) ? $_POST['nome_cliente'] : null;
    if (empty($nome_cliente)){
        header('Location: ../msg/msgErro.html');
    }
    
    $pesquisa = '%' . $nome_cliente . '%';
    $PDO = db_connect();
    $sql = "SELECT L.id as id_locacao, L.data_devolucao, C.id, C.nome_cliente as nome_cliente FROM locacao as L 
    INNER JOIN cliente as C on L.id_cliente = C.id WHERE upper(nome_cliente) like :nome_cliente ORDER BY L.id ASC";
    $stmt = $PDO->prepare($sql);
    $stmt->execute([':nome_cliente' => $pesquisa]);
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
              <th>Código da locação</th>
              <th>Nome do locatário:</th>
              <th>Data para devolução:</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
              <tr>
                <td><?php echo $user['id_locacao']; ?></td>
                <td><?php echo $user['nome_cliente']; ?></td>
                <td><?php echo converteData($user['data_devolucao']); ?></td>
                <td><a href="exibirVinilLocacoes.php?id=<?php echo $user['id_locacao']; ?>" class="btn btn-info">Administrar Vinis</a></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <a class="btn btn-primary" href="pesquisarLocacaoCliente.html">Nova Pesquisa</a>
        </div>
    </main>
    <div class="container">
        <footer class="footer rounded">
            <p>Samuel Maimone - Todos os direitos reservados &copy</p>
        </footer>
    </div>
</body>

</html>