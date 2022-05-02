<?php

require_once('config/config.php');

require_once('translations/pt_BR.php');

require_once('classes/Conexao.php');

require_once('classes/NovaPesquisa.php');

$novaPesquisa = new NovaPesquisa();

if ($novaPesquisa->usuario_encontrado == true) {
    include("views/novaPesquisa.php");
} else {
    include("views/pacienteNaoEncontrado.php");
}