<?php

require_once('config/config.php');

require_once('translations/pt_BR.php');

require_once('classes/Conexao.php');

require_once('classes/Dashboard.php');

$dashboard = new Dashboard();

include("views/dashboard.php");