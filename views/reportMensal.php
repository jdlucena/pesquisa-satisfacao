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
          <h1 class="h2">Relatório Mensal</h1>
        </div>
        <div class="accordion" id="accordionPanelsStayOpenExample">
        <?php foreach ($dashboard->result_ano as $value) { ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-heading<?=$value->ano?>">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?=$value->ano?>" aria-expanded="false" aria-controls="panelsStayOpen-collapse<?=$value->ano?>">
                <?=$value->ano?>
              </button>
            </h2>
            <div id="panelsStayOpen-collapse<?=$value->ano?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading<?=$value->ano?>">
              <div class="accordion-body">
              <?php $dashboard->listarMeses($value->ano); foreach ($dashboard->result_comp as $compete) { ?>
                <a href="?year=<?=$compete->ano?>&month=<?=$compete->mes?>" type="button" class="btn btn-outline-primary mb-2"><?=$compete->nomeMes?></a>
              <?php  } unset($dashboard->result_comp); ?>
              </div>
            </div>
          </div>
          <?php } ?>          
        </div>
      </main>
    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>

  <script src="assets/js/feather.min.js"></script>
  <script src="assets/js/dashboard.js"></script>



</body>

</html>