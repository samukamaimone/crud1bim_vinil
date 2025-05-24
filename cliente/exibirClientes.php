<?php
  require_once '../scripts/init.php';
  $PDO = db_connect();
  $sql = "SELECT id, nome_cliente, email, cpf FROM cliente ORDER BY id ASC";
  $stmt = $PDO->prepare($sql);
  $stmt->execute();
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Penhasco Silencioso Discos</title>
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
          Cliente cadastrado com sucesso!
        </div>
      </div>
    <?php elseif (isset($_GET['sucesso']) && $_GET['sucesso'] == 2): ?>
      <div class="container">
        <div class="alert alert-warning text-center">
          Cliente deletado com sucesso!
        </div>
      </div>
    <?php elseif (isset($_GET['sucesso']) && $_GET['sucesso'] == 3): ?>
      <div class="container">
        <div class="alert alert-success text-center">
          Cliente editado com sucesso!
        </div>
      </div>
    <?php endif; ?>
      <div class="container">
        <div class="jumbotron text-center">
          <p class="h3">Clientela</p>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Código</th>
              <th>Nome</th>
              <th>Email</th>
              <th>CPF</th>
              <th class="text-center" colspan="5">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
              <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['nome_cliente']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['cpf']; ?></td>
                <td class="d-flex justify-content-center">
                  <a href="formEditCliente.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">Editar</a>
                  <a href="deleteCliente.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');" class="btn btn-danger">Remover</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
  </main>
  <div class="container">
    <footer class="footer bg-light rounded">
      <p>Samuel Maimone - Todos os direitos reservados &copy</p>
    </footer>
  </div>
</body>

</html>