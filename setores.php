<?php

require_once('config/config.php');

require_once('translations/pt_BR.php');

require_once('classes/Conexao.php');

require_once('classes/Setores.php');

$setores = new Setores();

include("views/setores.php");