<?php

require_once('config/config.php');

require_once('translations/pt_BR.php');

require_once('classes/Conexao.php');

require_once('classes/Buscar.php');

$buscar = new Buscar();

include("views/buscar.php");