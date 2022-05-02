<!doctype html>
<html lang="pt-br">

  <?php require_once('_head.php') ?>

  <!-- Custom styles for this template -->
  <link href="assets/css/dashboard.css" rel="stylesheet">

</head>

<body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="./">Pesquisa de Satisfação</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  </header>

  <div class="container-fluid">
    <div class="row">

    <?php require_once('_menu.php') ?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Buscar Pesquisas</h1>
        </div>

        <div class="my-4 w-100" id="container"></div>

        <div class="col-md-12">
          <form class="needs-validation" action="buscar" method="post" novalidate>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="firstName" class="form-label">Data da Pesquisa</label>
                <div class="input-group mb-3">
                  <input type="date" class="form-control" value="<?=$buscar->dtinicial?>" name="dtinicio">
                  <span class="input-group-text">até</span>
                  <input type="date" class="form-control" value="<?=$buscar->dtfinal?>" name="dtfim">
                </div>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-left mb-5">
                  <button type="submit" class="btn btn-sm btn-primary btn-lg px-4 gap-3">Buscar</button>
                  <a href="?periodo=hoje" class="btn btn-sm btn-primary btn-lg px-4">Hoje</a>
                  <a href="?periodo=ontem" class="btn btn-sm btn-primary btn-lg px-4">Ontem</a>
                  <a href="?periodo=ultimaSemana" class="btn btn-sm btn-primary btn-lg px-4">Última semana</a>
                </div>
              </div>
            </div>
          </form>
        </div>

        <h2>Pesquisas Encontradas</h2>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">N°</th>
                <th scope="col">Paciente</th>
                <th scope="col">Leito</th>
                <th scope="col">Setor</th>
                <th scope="col">Data</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($buscar->result_consulta_pesquisa as $value) { ?>
                <tr>
                  <td><a href="editarPesquisa?idRegistro=<?= $value->id ?>"><?= $value->id ?></a></td>
                  <td><?= $value->nomePaciente ?></td>
                  <td><?= $value->leito ?></td>
                  <td><?= $value->setor ?></td>
                  <td><?= $value->dtRegistro ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>

  <script src="assets/js/feather.min.js"></script>
  <script src="assets/js/dashboard.js"></script>

  <script src="assets/js/iziToast.min.js"></script>

  <script>
    // evita o reenvio do formulario caso usuario atualize a página
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
  </script>

</body>
</html>
<?php
if (isset($buscar)) {
    if ($buscar->errors) {
        foreach ($buscar->errors as $error) { ?><script>iziToast.error({title: '<?=$error;?>',position: 'topRight',timeout: 7000,});</script><?php } }
    if ($buscar->messages) {
        foreach ($buscar->messages as $message) { ?><script>iziToast.success({title: '<?=$message;?>',position: 'topRight',timeout: 10000,});</script><?php } }
} ?>