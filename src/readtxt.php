<?php

$filename = "../tmp/contatos.txt";

if (file_exists($filename)) {

	$ponteiro = fopen ($filename, "r");

	$contato = array();

	while (!feof ($ponteiro)) {
		$linha = str_replace("\r\n",";",trim(fgets($ponteiro, 4096)));
		$linha = preg_replace("/[^0-9]/", "", $linha);
		if (substr($linha, 0,1) == '0') {
			$linha = substr($linha, 1);
		}
		if ((strlen($linha) == 10) || (strlen($linha) == 11)) {
			array_push($contato, $linha);
		}
	}

	fclose ($ponteiro);

	include_once('api.php');


	unlink ("../tmp/contatos.txt");
} else {
	$erro = array("erro"=>"");
	echo json_encode($erro);
}