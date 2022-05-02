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

      <form class="needs-validation form-group" novalidate action="./" method="post">
        <div class="row g-1">
          <h4 class="mb-3">Perfil do entrevistado</h4>
          <div class="col-sm-3">
            <label for="registro" class="form-label">Registro</label>
            <input type="text" class="form-control" name="registro" value="<?= $novaPesquisa->dados_do_paciente->PAC_REG ?>" readonly>
          </div>
          <div class="col-sm-6">
            <label for="paciente" class="form-label">Paciente</label>
            <input type="text" class="form-control" name="paciente" value="<?= $novaPesquisa->dados_do_paciente->PAC_NOME ?>" readonly>
          </div>
          <div class="col-sm-3">
            <label for="genero" class="form-label">Gênero</label>
            <input type="text" class="form-control" name="genero" value="<?= $novaPesquisa->dados_do_paciente->SEXO ?>" readonly>
          </div>

          <div class="col-sm-3">
            <label for="municipio" class="form-label">Município</label>
            <input type="text" class="form-control" name="municipio" value="<?= $novaPesquisa->dados_do_paciente->CDE_NOME ?>/<?= $novaPesquisa->dados_do_paciente->PAC_UF ?>" readonly>
          </div>
          <div class="col-sm-3">
            <label for="setor" class="form-label">Setor</label>
            <input type="text" class="form-control" name="setor" value="<?= $novaPesquisa->dados_do_paciente->STR_NOME ?>" readonly>
          </div>
          <div class="col-sm-3">
            <label for="leito" class="form-label">Leito</label>
            <input type="text" class="form-control" name="leito" value="<?= $novaPesquisa->dados_do_paciente->LOC_NOME ?>" readonly>
          </div>
          <div class="col-sm-3">
            <label for="internado" class="form-label">Internado</label>
            <input type="text" class="form-control" name="internado" value="<?= $novaPesquisa->dados_do_paciente->ENTRADA ?> DIAS" readonly>
          </div>
        </div>
        <div class="row g-5 my-1">
          <div class="col-md-12">
            <h4 class="mb-3">Questionário</h4>
            
            <?php

            // variável para numerar as questões
            $i = 1;

            // condição para gerar as questões
            foreach (SETORES as $key => $values) :

            ?>

              <div class="row g-3">
                <div class="col-12">
                  <label for="<?= $key ?>" class="form-label"><?= $i ?>. Como você avalia o setor de <?= $values ?>?</label><br>
                  <div class="btn-group btn-group-lg" role="group">
                    <input type="radio" class="btn-check" name="<?= $key ?>" id="<?= $key ?>1" value="1">
                    <label class="btn btn-outline-success" for="<?= $key ?>1" data-bs-toggle="tooltip" title="Ótimo">😁</label>

                    <input type="radio" class="btn-check" name="<?= $key ?>" id="<?= $key ?>2" value="2">
                    <label class="btn btn-outline-success" for="<?= $key ?>2" data-bs-toggle="tooltip" title="Bom">😀</label>

                    <input type="radio" class="btn-check" name="<?= $key ?>" id="<?= $key ?>3" value="3">
                    <label class="btn btn-outline-success" for="<?= $key ?>3" data-bs-toggle="tooltip" title="Regular">😐</label>

                    <input type="radio" class="btn-check" name="<?= $key ?>" id="<?= $key ?>4" value="4">
                    <label class="btn btn-outline-success" for="<?= $key ?>4" data-bs-toggle="tooltip" title="Ruim">🙁</label>

                    <input type="radio" class="btn-check" name="<?= $key ?>" id="<?= $key ?>5" value="5">
                    <label class="btn btn-outline-success" for="<?= $key ?>5" data-bs-toggle="tooltip" title="Péssimo">😩</label>

                    <input type="radio" class="btn-check" name="<?= $key ?>" id="<?= $key ?>6" value="0" checked>
                    <label class="btn btn-outline-dark" for="<?= $key ?>6" data-bs-toggle="tooltip" title="Não utilizado">😶</label>
                  </div>                  
                </div>
              </div>
              
              <button class="btn btn-sm btn-outline-success mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample<?=$i?>" aria-expanded="false" aria-controls="collapseExample<?=$i?>">
                <small>Observação</small>
              </button>
              <div class="collapse mt-2" id="collapseExample<?=$i?>">
                <div class="form-group">
                 <textarea class="form-control" name="obs<?= $key ?>" rows="5"></textarea>
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

            <button class="w-100 btn btn-dark btn-lg" name="cadastrar" type="submit">Cadastrar</button>

          </div>
        </div>
      </form>
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
        foreach ($novaPesquisa->messages as $message) { ?><script>iziToast.success({title: '<?=$message;?>',position: 'topRight',timeout: 10000,});</script><?php } }
} ?>