<!doctype html>
<html lang="pt-br" class="h-100">

<?php require_once('_head.php') ?>

<body class="d-flex flex-column h-100 bg-light">

  <main class="flex-shrink-0">
    <div class="container">
      <div class="py-1 text-center">
        <a href="./"><img class="d-block mx-auto" src="assets/images/logo.svg" alt="" width="200"></a>
        <h2>Pesquisa de Satisfação</h2>
        <p class="lead">Avaliação da qualidade dos serviços da instituição por acompanhantes dos pacientes internados.</p>
      </div>

      <div class="py-5 text-center">
        <div class="py-5 text-center">
          <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a href="./" class="btn btn-primary btn-lg px-4 gap-3">Página Inicial</a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php require_once('_footer.php') ?>

  <?php require_once('_scripts.php') ?>
</body>

</html>

<?php
if (isset($novaPesquisa)) {
    if ($novaPesquisa->errors) {
        foreach ($novaPesquisa->errors as $error) { ?><script>iziToast.error({title: '<?=$error;?>',position: 'topRight',timeout: 7000,});</script><?php } }
    if ($novaPesquisa->messages) {
        foreach ($novaPesquisa->messages as $message) { ?><script>iziToast.success({title: '<?=$message;?>',position: 'topRight',timeout: 7000,});</script><?php } }
} ?>