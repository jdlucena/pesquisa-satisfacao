<?php

require_once('config/config.php');

require_once('translations/pt_BR.php');

require_once('classes/Conexao.php');

require_once('classes/Relatorios.php');

$relatorios = new Relatorios();
    
include("views/reportMensalPrint.php");

