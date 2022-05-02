<!doctype html>
<html lang="pt-br" class="h-100">

<?php require_once('_head.php') ?>

<body class="d-flex flex-column h-100 bg-light">

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Excluir Pesquisa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h4>Tem certeza que deseja excluir essa pesquisa?</h4>
        </div>
        <div class="modal-footer">
          <form class="needs-validation form-group" novalidate action="./" method="post">
            <input type="hidden" value="<?= $novaPesquisa->exibePaciente->id ?>" name="id_pesquisa_excluir">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger" name="excluir">Excluir</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <main class="flex-shrink-0">
    <div class="container">
      <div class="py-1 text-center">
        <a href="./"><img class="d-block mx-auto" src="assets/images/logo.svg" alt="" width="200"></a>
        <h2>Pesquisa de Satisfação</h2>
        <p class="lead">Avaliação da qualidade dos serviços da instituição por acompanhantes dos pacientes internados.</p>
      </div>

      <form class="needs-validation form-group" novalidate action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
        <div class="row g-1">
          <input type="hidden" value="<?= $novaPesquisa->exibePaciente->id ?>" name="id_pesquisa">
          <h4 class="mb-3">Perfil do entrevistado</h4>
          <div class="col-sm-3">
            <label for="registro" class="form-label">Registro</label>
            <input type="text" class="form-control" name="registro" value="<?= $novaPesquisa->exibePaciente->registro ?>" readonly>
          </div>
          <div class="col-sm-6">
            <label for="paciente" class="form-label">Paciente</label>
            <input type="text" class="form-control" name="paciente" value="<?= $novaPesquisa->exibePaciente->nomePaciente ?>" readonly>
          </div>
          <div class="col-sm-3">
            <label for="genero" class="form-label">Gênero</label>
            <input type="text" class="form-control" name="genero" value="<?= $novaPesquisa->exibePaciente->genero ?>" readonly>
          </div>

          <div class="col-sm-3">
            <label for="municipio" class="form-label">Município</label>
            <input type="text" class="form-control" name="municipio" value="<?= $novaPesquisa->exibePaciente->municipio ?>" readonly>
          </div>
          <div class="col-sm-3">
            <label for="setor" class="form-label">Setor</label>
            <input type="text" class="form-control" name="setor" value="<?= $novaPesquisa->exibePaciente->setor ?>" readonly>
          </div>
          <div class="col-sm-3">
            <label for="leito" class="form-label">Leito</label>
            <input type="text" class="form-control" name="leito" value="<?= $novaPesquisa->exibePaciente->leito ?>" readonly>
          </div>
          <div class="col-sm-3">
            <label for="internado" class="form-label">Internado</label>
            <input type="text" class="form-control" name="internado" value="<?= $novaPesquisa->exibePaciente->diasInternado ?>" readonly>
          </div>
        </div>
        <div class="row g-5 my-1">
          <div class="col-md-12">
            <h4 class="mb-3">Questionário</h4>

            <?php

            // variável para numerar as questões
            $i = 1;

            // condição para gerar as questões
            foreach (SETORES as $key => $values) : $testi = 'obs'.$key;

            ?>
              <div class="row g-3">
                <div class="col-12">
                  <label for="<?= $key ?>" class="form-label"><?= $i ?>. Como você avalia o setor de <?= $values ?>?</label><br>
                  <div class="btn-group btn-group-lg" role="group">
                    <input type="radio" class="btn-check" name="<?= $key ?>" id="<?= $key ?>1" value="1" <?= ($novaPesquisa->exibePaciente->$key) == 1 ? 'checked' : '' ?>>
                    <label class="btn btn-outline-success" for="<?= $key ?>1" data-bs-toggle="tooltip" title="Ótimo">😁</label>

                    <input type="radio" class="btn-check" name="<?= $key ?>" id="<?= $key ?>2" value="2" <?= ($novaPesquisa->exibePaciente->$key) == 2 ? 'checked' : '' ?>>
                    <label class="btn btn-outline-success" for="<?= $key ?>2" data-bs-toggle="tooltip" title="Bom">😀</label>

                    <input type="radio" class="btn-check" name="<?= $key ?>" id="<?= $key ?>3" value="3" <?= ($novaPesquisa->exibePaciente->$key) == 3 ? 'checked' : '' ?>>
                    <label class="btn btn-outline-success" for="<?= $key ?>3" data-bs-toggle="tooltip" title="Regular">😐</label>

                    <input type="radio" class="btn-check" name="<?= $key ?>" id="<?= $key ?>4" value="4" <?= ($novaPesquisa->exibePaciente->$key) == 4 ? 'checked' : '' ?>>
                    <label class="btn btn-outline-success" for="<?= $key ?>4" data-bs-toggle="tooltip" title="Ruim">☹</label>

                    <input type="radio" class="btn-check" name="<?= $key ?>" id="<?= $key ?>5" value="5" <?= ($novaPesquisa->exibePaciente->$key) == 5 ? 'checked' : '' ?>>
                    <label class="btn btn-outline-success" for="<?= $key ?>5" data-bs-toggle="tooltip" title="Péssimo">😩</label>

                    <input type="radio" class="btn-check" name="<?= $key ?>" id="<?= $key ?>6" value="0" <?= ($novaPesquisa->exibePaciente->$key) == 0 ? 'checked' : '' ?>>
                    <label class="btn btn-outline-dark" for="<?= $key ?>6" data-bs-toggle="tooltip" title="Não utilizado">😶</label>
                  </div>
                </div>
              </div>

              <button class="btn btn-sm btn-outline-success mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample<?=$i?>" aria-expanded="false" aria-controls="collapseExample<?=$i?>">
                <small>Observação</small>
              </button>
              <div class="collapse mt-2" id="collapseExample<?=$i?>">
                <div class="form-group">
                 <textarea class="form-control" name="obs<?= $key ?>" rows="5"><?=$novaPesquisa->exibePaciente->$testi?></textarea>
                </div>
              </div>

              <hr class="my-4">

            <?php

              // incrementa o número das questões
              $i++;

            // fim da condição foreach
            endforeach;

            ?>

            <!--
            <div class="row g-3">
              <div class="col-12">
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">17. Observações</label>
                  <textarea class="form-control" name="observacoes" rows="5"></textarea>
                </div>
              </div>
            </div>
            -->

            <div class="d-grid gap-2">
              <button class="w-100 btn btn-primary btn-lg" name="editar" type="submit">Editar</button>
              <button class="w-100 btn btn-danger btn-lg" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Excluir</button>
            </div>

          </div>
        </div>
      </form>
    </div>
  </main>

  <?php require_once('_footer.php') ?>

  <?php require_once('_scripts.php') ?>

  <script>
		// evita o reenvio do formulario caso usuario atualize a página
	    if ( window.history.replaceState ) {
	        window.history.replaceState( null, null, window.location.href );
	    }
	</script>
</body>

</html>

<?php
if (isset($novaPesquisa)) {
    if ($novaPesquisa->errors) {
        foreach ($novaPesquisa->errors as $error) { ?><script>iziToast.error({title: '<?=$error;?>',position: 'topRight',timeout: 7000,});</script><?php } }
    if ($novaPesquisa->messages) {
        foreach ($novaPesquisa->messages as $message) { ?><script>iziToast.success({title: '<?=$message;?>',position: 'topRight',timeout: 10000,});</script><?php } }
} ?>