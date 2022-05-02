<!doctype html>
<html lang="pt-br">

<?php require_once('_head.php') ?>

<!-- Custom styles for this template -->
<link href="assets/css/dashboard.css" rel="stylesheet">

<!-- HighCharts -->
<script src="assets/js/highcharts.js"></script>

<style>
  /* Estilo da barra lateral */
  /* width */
  ::-webkit-scrollbar {
    width: 10px;
  }

  /* Track */
  ::-webkit-scrollbar-track {
    background: #f1f1f1; 
  }
  
  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #888; 
  }

  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #555; 
  }
</style>

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
          <h1 class="h2">Relatório mensal <?= $dashboard->nomeMes($_GET['month']) ?> de <?= $_GET['year'] ?></h1>
        </div>
        <?php foreach (SETORES as $key => $value) { ?>

          <!-- Modal -->
          <div class="modal fade" id="staticBackdrop<?= $key ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel<?= $key ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel<?= $key ?>">Observação relatório final</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation form-group" novalidate action="?year=<?=$_GET['year']?>&month=<?=$_GET['month']?>" method="post">
                      <input type="hidden" name="setor" value="<?= $key ?>">
                      <div class="form-group">
                        <textarea class="form-control" name="observacaoFinal" rows="5"><?=$dashboard->observacaoRelatorioMensalPDF($_GET['year'],$_GET['month'],$key)?></textarea>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="editarObs">Editar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>


          <div class="my-4 w-100" id="<?= $key ?>"></div>
          <div class="my-3 p-3 bg-body rounded shadow-sm" style="max-height: 300px; overflow-y: scroll;">
            <div class="d-flex justify-content-between align-items-center">
              <h6 class="pb-0 mb-0">Observações</h6>
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-primary mb-2 justify-content-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $key ?>" data-tt="tooltip" title="Editar observação"><span data-feather="edit"></span></button>
                <a href="reportMensalPrint?month=<?= $_GET['month'] ?>&year=<?= $_GET['year'] ?>&setor=<?= $key ?>" class="btn btn-sm btn-outline-primary mb-2 justify-content-end botao" tabindex="-1" role="button" aria-disabled="true" data-bs-toggle="tooltip" title="Imprimir relatório"><span data-feather="printer"></span></a>
              </div>              
            </div>

            <?php 
              // lista as observações de cada setor
              foreach ($dashboard->result_pesquisa_obs as $value): 
              
              // pega a coluna qtSetor e verifica na constante SETORES_OBS para retornar obsqtSetor
              $obsSetor = SETORES_OBS[$key]; 

              // verifica se a observação é null
              if (!is_null($value->$obsSetor)):
            ?>
                <div class="d-flex text-muted pt-3">
                  <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                    <div class="d-flex justify-content-between">
                      <strong class="text-gray-dark">Pesquisa #<?= $value->id ?></strong>
                    </div>
                    <span class="d-block"><?= $value->$obsSetor ?>.</span>
                  </div>
                </div>
            <?php
              endif;
              endforeach;
            ?>
          </div>
          <hr>
        <?php } ?>
      </main>
    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>

  <script src="assets/js/feather.min.js"></script>
  <script src="assets/js/dashboard.js"></script>
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/iziToast.min.js"></script>

  <script>
    // evita o reenvio do formulario caso usuario atualize a página
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
    
    // Ativar todos tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    
    // desabilitar botão print
    $(document).ready(function() {
      $(".botao").click(function() {
        $(this).removeClass("btn-outline-primary") // remove a classe primary
        $(this).addClass("btn-outline-secondary") // adicionar a classe secondary
        $(this).addClass("disabled") // desabilita o botão
      });
    });

    // tooltip do botão observação já que tem o modal
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-tt="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
  </script>

  <script>
    // retorna para a div do setor que foi feito a alteração da observação, rolagem automática
    $(document).ready(function() { 
      window.location.href="#<?=$_POST['setor']?>";
    });
  </script>

  <?php

  // lista o nome dos setores igual como está no banco
  foreach (SETORES as $qtSetor => $value) {

    // soma total inicial das questões de cada setor para o gráfico ficar uniforme
    $soma = 0;

  ?>
    <script>
      var data = [
        <?php
        // lista o resultado do setor
        foreach ($dashboard->result_pesquisa as $respostas) {

          // soma o resultado para quantidade máxima no gráfico
          $soma += $respostas->$qtSetor;

          // imprime respostas do setor 
          echo $respostas->$qtSetor . ',';
        } ?>
      ];
      var dataSum = 0;
      for (var i = 0; i < data.length; i++) {
        dataSum += data[i]
      }
      var chart = new Highcharts.Chart({
        chart: {
          renderTo: "<?= $qtSetor ?>",
          type: 'bar',
          height: 300
        },
        credits: {
          enabled: false
        },
        title: {
          text: "<?= $value ?>"
        },
        xAxis: {
          categories: [<?php foreach ($dashboard->result_pesquisa as $value) { ?> "<?= $value->questao ?>", <?php } ?>],
          reversed: true
        },
        yAxis: {
          max: <?= $soma ?>,
          title: {
            text: ""
          },
          labels: {
            enabled: false,
          }
        },
        plotOptions: {
          series: {
            animation: false,
            shadow: false,
            borderWidth: 0,
            dataLabels: {
              enabled: true,
              formatter: function() {
                var pcnt = (this.y / dataSum) * 100;
                return Highcharts.numberFormat(pcnt, 0) + '%';
              }
            }
          }
        },
        legend: {
          enabled: false
        },
        series: [{
          name: "Pesquisas",
          data: data
        }]
      });
    </script>

  <?php
  } // fim dos foreach inicial 
  ?>

</body>
</html>
<?php
if (isset($dashboard)) {
    if ($dashboard->errors) {
        foreach ($dashboard->errors as $error) { ?><script>iziToast.error({title: '<?=$error;?>',position: 'topRight',timeout: 7000,});</script><?php } }
    if ($dashboard->messages) {
        foreach ($dashboard->messages as $message) { ?><script>iziToast.success({title: '<?=$message;?>',position: 'topRight',timeout: 10000,});</script><?php } }
} ?>