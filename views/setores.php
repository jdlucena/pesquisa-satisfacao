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
          <h1 class="h2">Setores</h1>
        </div>

        <div class="my-4 w-100" id="container"></div>

        <div class="col-md-12">
          <form class="needs-validation" action="setores" method="post" novalidate>
            <?php foreach ($setores->result_consulta_setores as $value) : ?>
            <div class="row g-3 mb-1">
              <div class="col-md">
                <div class="form-floating">
                  <input type="text" class="form-control" name="setor<?=$value->codigo?>" value="<?=$value->setor?>">
                  <label>Setor</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating">
                  <input type="text" class="form-control" name="resp<?=$value->codigo?>" value="<?=$value->responsavel?>">
                  <label>Responsável</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating">
                  <input type="email" class="form-control" name="email<?=$value->codigo?>" value="<?=$value->email?>">
                  <label>E-mail</label>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
            <div class="mt-3 mb-5">
              <button type="submit" class="btn btn-primary" name="enviarSetores">Enviar</button>
            </div>
          </form>
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
if (isset($setores)) {
    if ($setores->errors) {
        foreach ($setores->errors as $error) { ?><script>iziToast.error({title: '<?=$error;?>',position: 'topRight',timeout: 7000,});</script><?php } }
    if ($setores->messages) {
        foreach ($setores->messages as $message) { ?><script>iziToast.success({title: '<?=$message;?>',position: 'topRight',timeout: 10000,});</script><?php } }
} ?>