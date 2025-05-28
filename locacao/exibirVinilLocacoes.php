<?php
    require_once '../scripts/init.php';
    $PDO = db_connect();

    $id_locacao = isset($_GET['id']) ? (int)$_GET['id'] : null;
    if (!$id_locacao) {
    echo "ID da locação não fornecido.";
    exit;
    }

    $sql = "SELECT VL.id_locacao, VL.id_vinil, V.titulo, L.data_hora,
            L.data_devolucao, L.id as id, C.nome_cliente
            FROM vinil_locacao as VL
            INNER JOIN locacao as L ON VL.id_locacao = L.id
            INNER JOIN vinil as V ON VL.id_vinil = V.id
            INNER JOIN cliente as C ON L.id_cliente = C.id
            WHERE VL.id_locacao = :id_locacao
            ORDER BY V.titulo ASC";

    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id_locacao', $id_locacao, PDO::PARAM_INT);
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
          Vinil registrado com sucesso!
        </div>
      </div>
    <?php elseif (isset($_GET['sucesso']) && $_GET['sucesso'] == 2): ?>
      <div class="container">
        <div class="alert alert-warning text-center">
        Vinil removido com sucesso!
        </div>
      </div>
    <?php elseif (isset($_GET['sucesso']) && $_GET['sucesso'] == 3): ?>
      <div class="container">
        <div class="alert alert-success text-center">
        Vinil alterado com sucesso!
        </div>
      </div>
    <?php endif; ?>
      <div class="container">
        <div class="jumbotron text-center">
          <p class="h3">Vinis da Locação</p>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Código Locação</th>
              <th>Nome Locatário</th>
              <th>Vinis da locação</th>
              <th>Data para devolução</th>
              <th class="text-center" colspan="5">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
              <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['nome_cliente']; ?></td>
                <td><?php echo $user['titulo']; ?></td>
                <td><?php echo converteData($user['data_devolucao']); ?></td>
                <td class="d-flex justify-content-center">
                  <a href="deleteVinilLocacao.php?id=<?php echo $user['id_locacao']; ?>&id_vinil=<?php echo $user['id_vinil']; ?>" 
                    onclick="return confirm('Tem certeza de que deseja remover?');" class="btn btn-danger">Remover Vinil</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <a href="exibirLocacoes.php" class="btn btn-primary">Voltar</a>
        <a href="formAddVinilLocacao.php?id=<?php echo $id_locacao; ?>" class="btn btn-info">Adicionar vinil</a>
      </div>
  </main>
  <div class="container">
    <footer class="footer rounded">
      <p>Samuel Maimone - Todos os direitos reservados &copy</p>
    </footer>
  </div>
</body>

</html>