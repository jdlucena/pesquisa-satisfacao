<?php

require_once('config/config.php');

require_once('translations/pt_BR.php');

require_once('classes/Conexao.php');

require_once('classes/PacientesInternados.php');

$pacientes = new PacientesInternados();

include("views/selecionarPaciente.php");