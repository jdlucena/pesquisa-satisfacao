<?php

require_once('config/config.php');

require_once('translations/pt_BR.php');

require_once('classes/Conexao.php');

require_once('classes/Dashboard.php');

$dashboard = new Dashboard();

if ($dashboard->usuario_encontrado == true) {
    
    // tela para exibir o resultado do ano e mês selecionado
    if ($dashboard->exibir == true) {
        include("views/reportMensalResultado.php");
    } else {
        include("views/reportMensal.php");
    }
        
} else {
    include("views/pacienteNaoEncontrado.php");
}