<?php
  require_once '../scripts/init.php';
  $PDO = db_connect();
  $sql = "SELECT L.id as id, L.data_hora, L.data_devolucao, C.nome_cliente as nome_cliente FROM locacao as L INNER JOIN cliente as C
          on L.id_cliente = C.id ORDER BY L.id ASC";
  $stmt = $PDO->prepare($sql);
  $stmt->execute();
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Locações - Seborréia Discos</title>
  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
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
    <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1): ?>
      <div class="container">
        <div class="alert alert-success text-center">
          Locação registrada com sucesso!
        </div>
      </div>
    <?php elseif (isset($_GET['sucesso']) && $_GET['sucesso'] == 2): ?>
      <div class="container">
        <div class="alert alert-warning text-center">
        Locação desfeita com sucesso!
        </div>
      </div>
    <?php elseif (isset($_GET['sucesso']) && $_GET['sucesso'] == 3): ?>
      <div class="container">
        <div class="alert alert-success text-center">
        Locação editada com sucesso!
        </div>
      </div>
    <?php endif; ?>
      <div class="container">
        <div class="jumbotron text-center">
          <p class="h3">Locações</p>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Código</th>
              <th>Locatário</th>
              <th>Data e hora da locação</th>
              <th>Data para devolução</th>
              <th class="text-center" colspan="5">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
              <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['nome_cliente']; ?></td>
                <td><?php echo converteDataHora($user['data_hora']); ?></td>
                <td><?php echo converteData($user['data_devolucao']); ?></td>
                <td class="d-flex justify-content-center">
                    <a href="formEditLocacao.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">Editar</a>
                    <a href="deleteLocacao.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');" class="btn btn-danger">Remover</a>
                    <a href="exibirVinilLocacoes.php?id=<?php echo $user['id']; ?>" class="btn btn-info">Administrar Vinis</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
  </main>
  <div class="container">
    <footer class="footer rounded">
      <p>Samuel Maimone - Todos os direitos reservados &copy</p>
    </footer>
  </div>
</body>

</html>