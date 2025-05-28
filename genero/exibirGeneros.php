<?php
  require_once '../scripts/init.php';
  $PDO = db_connect();
  $sql = "SELECT id, nome_genero, corredor FROM genero ORDER BY id ASC";
  $stmt = $PDO->prepare($sql);
  $stmt->execute();
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gêneros - Seborréia Discos</title>
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
          Gênero cadastrado com sucesso!
        </div>
      </div>
    <?php elseif (isset($_GET['sucesso']) && $_GET['sucesso'] == 2): ?>
      <div class="container">
        <div class="alert alert-warning text-center">
          Gênero deletado com sucesso!
        </div>
      </div>
    <?php elseif (isset($_GET['sucesso']) && $_GET['sucesso'] == 3): ?>
      <div class="container">
        <div class="alert alert-success text-center">
          Gênero editado com sucesso!
        </div>
      </div>
    <?php elseif (isset($_GET['sucesso']) && $_GET['sucesso'] == 0): ?>
      <div class="container">
        <div class="alert alert-danger text-center">
          Operação cancelada. Gênero está em um relacionamento!
        </div>
      </div>
    <?php endif; ?>
      <div class="container">
        <div class="jumbotron text-center">
          <p class="h3">Gêneros musicais do acervo</p>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Código</th>
              <th>Nome do gênero musical:</th>
              <th>Localização (corredor):</th>
              <th class="text-center" colspan="5">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
              <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['nome_genero']; ?></td>
                <td><?php echo $user['corredor']; ?></td>
                <td class="d-flex justify-content-center">
                  <a href="formEditGenero.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">Editar</a>
                  <a href="deleteGenero.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');" class="btn btn-danger">Remover</a>
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