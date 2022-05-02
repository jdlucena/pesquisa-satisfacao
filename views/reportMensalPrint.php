<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <title>Relatório Mensal Final</title>
  <link rel="stylesheet" href="<?= ENDERECO ?>assets/css/style.css" media="all" />
  <script src="<?= ENDERECO ?>assets/js/highcharts8.0.4.js"></script>
  <style>
    
  </style>
</head>

<body>
  <header class="clearfix">
    <div id="logo">
      <img src="<?= ENDERECO ?>assets/images/logo.png">
    </div>
    <div id="company">
      <h2 class="name">Hospital Infantil Varela Santiago</h2>
      <div>+55 (84) 3209-8200</div>
      <div><a href="mailto:pesquisa@hospitalvarelasantiago.org.br">pesquisa@hospitalvarelasantiago.org.br</a></div>
    </div>
  </header>
  <main>
    <div id="details" class="clearfix">
      <div id="client">
        <div class="to">RELATÓRIO PESQUISA DE SATISFAÇÃO</div>
        <h2 class="name">Setor: <?= $relatorios->cabecalho->setor ?></h2>
        <div class="address">Responsável: <?= $relatorios->cabecalho->responsavel ?></div>
        <div class="email"><a href="mailto:<?= $relatorios->cabecalho->email ?>"><?= $relatorios->cabecalho->email ?></a></div>
      </div>
      <div id="invoice">
        <h1><?= $relatorios->cabecalho->competencia ?></h1>
        <div class="date">TOTAL DE ENTREVISTADOS</div>
        <div class="date"><?= $relatorios->cabecalho->quantidade ?>/<?= $relatorios->cabecalho->total ?></div>
      </div>
    </div>
    <div id="container"></div>
    <div id="thanks">FEEDBACK DOS ACOMPANHANTES</div>

    <div id="notices">
      <div class="notice">
        <?= nl2br(stripcslashes($relatorios->result_observacoes)) ?>
      </div>
      <hr class="hrObs">
    </div>
  </main>

  <script>
    var data = [
      <?php $soma = 0;
      foreach ($relatorios->result_print as $value) {
        echo $value->questoes . ',';  // soma o resultado para quantidade máxima no gráfico
        $soma += $value->questoes;
      } ?>
    ];
    var dataSum = 0;
    for (var i = 0; i < data.length; i++) {
      dataSum += data[i]
    }
    var chart = new Highcharts.Chart({
      chart: {
        renderTo: "container",
        type: 'bar',
        height: 300
      },
      credits: {
        enabled: false
      },
      title: {
        text: ""
      },
      xAxis: {
        categories: [<?php foreach ($relatorios->result_print as $value) { ?> "<?= $value->questao ?>", <?php } ?>],
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
</body>

</html>
<?php
// configurações de utilização do wkhtmltopdf
// carregando o autoload
require_once 'vendor/autoload.php';

// instanciando a classe de Pdf
use mikehaertl\wkhtmlto\Pdf;

/*
$options = [
  'footer-html' => 'http://localhost/pesquisa/views/_footer_pdf.php' // footer da impressão
];
*/

// definindo qual a URL a ser transformada em PDF
$pdf = new Pdf(ob_get_clean());

// definindo as opções
#$pdf->setOptions($options);

// definindo o caminho do binário
$pdf->binary = 'C:\wamp64\www\pesquisa\wkhtmltox\bin\wkhtmltopdf.exe';

// precisa colocar esse parametros apos o nome do arquivo, se não o pdf fica corrompido
$pdf->send('relatorioMensalFinal.pdf', false, array(
  'Content-Length' => false,
));
?>