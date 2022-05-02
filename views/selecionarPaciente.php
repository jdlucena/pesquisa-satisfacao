<!doctype html>
<html lang="pt-br" class="h-100">

<?php require_once('_head.php') ?>

<body class="d-flex flex-column h-100 bg-light">

  
  <?php
      
      // verifica se o paciente já foi entrevistado
      for ($i=0; $i < $pacientes->paciente_internados; $i++) {
        // verifica se os registros dos pacientes internados estão no array das entrevistas cadastradas
        if (in_array($pacientes->a[$i]->PAC_REG, $pacientes->registros)) {
          $pacientes->a[$i]->ENTREVISTA = '<span class="badge bg-success">SIM</span></h6>';
        }        
      }
      
      ?>
    <main class="flex-shrink-0">
      <div class="container">
      <div class="py-1 text-center">
      <a href="./"><img class="d-block mx-auto" src="assets/images/logo.svg" alt="" width="200"></a>
        <h2>Pesquisa de Satisfação</h2>
        <p class="lead">Avaliação da qualidade dos serviços da instituição por acompanhantes dos pacientes internados.</p>
      </div>
      <table id="example" class="display" style="width:100%">
        <thead>
          <tr>
            <th>Paciente</th>
            <th>Leito</th>
            <th data-bs-toggle="tooltip" title="Pacientes entrevistados nos últimos 30 dias">Entrevistado</th>
          </tr>
        </thead>
        <tbody>
          <?php for ($i=0; $i < $pacientes->paciente_internados; $i++) { ?>
            <tr>
              <td>
                <a href="novaPesquisa?registro_paciente=<?=$pacientes->a[$i]->PAC_REG?>"><?=rtrim($pacientes->a[$i]->PAC_REG)?></a>
                <?=$pacientes->a[$i]->PAC_NOME?>
                <br>
                <small>MÃE: <?=$pacientes->a[$i]->PAC_NOME_MAE?></small>
              </td>
              <td>
                <?=$pacientes->a[$i]->STR_NOME?>
                <br>
                <small><?=$pacientes->a[$i]->LOC_NOME?></small>
              </td>
              <td class="text-center">
                <?=$pacientes->a[$i]->ENTREVISTA?> <span class="badge bg-secondary" data-bs-toggle="tooltip" title="<?=$pacientes->a[$i]->PAC_FONE?>">TEL</span></h6>
              </td>
            </tr>
          <?php } ?>
      </table>
    </div>
    </main>

    <?php require_once('_footer.php') ?>

  
  <?php require_once('_scripts.php') ?>

</body>

</html>