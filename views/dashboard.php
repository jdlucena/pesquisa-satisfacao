<!doctype html>
<html lang="pt-br">

  <?php require_once('_head.php') ?>

  <!-- Custom styles for this template -->
  <link href="assets/css/dashboard.css" rel="stylesheet">

  <!-- HighCharts -->
  <script src="assets/js/highcharts.js"></script>
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
          <h1 class="h2">Dashboard</h1>
        </div>

        <div class="my-4 w-100" id="container"></div>

        <h2>Últimas Pesquisas</h2>
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
              <?php foreach ($dashboard->result_questionario as $value) { ?>
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
  <script src="assets/js/Chart.min.js"></script>
  <script src="assets/js/dashboard.js"></script>

  <script>
    Highcharts.chart("container", {
      chart: {
        height: 500
      },
      credits: {
        enabled: false
      },
      title: {
        text: ""
      },
      yAxis: {
        title: {
          text: ""
        }
      },
      xAxis: {
        categories: [<?php foreach ($dashboard->result_consulta_mes as $value) { ?> "<?= $value->mensal ?>", <?php } ?>],
        reversed: true
      },
      legend: {
        enabled: false
      },
      series: [{
        name: "Pesquisas",
        data: [<?php foreach ($dashboard->result_consulta_mes as $value) { ?> <?= $value->quantidade ?>, <?php } ?>]
      }],
      responsive: {
        rules: [{
          condition: {
            maxWidth: 500
          },
          chartOptions: {
            legend: {
              layout: "horizontal",
              align: "center",
              verticalAlign: "bottom"
            }
          }
        }]
      },
    });
  </script>
</body>

</html>