<?php
session_start();

include_once('usuario.php');

if (count($_POST) == 7) {
	$id_usuario = $_POST['id_usuario'];
	$adm = $_SESSION['cnsopr_'];

	$user = new Usuario();
	$user->setId($id_usuario);
		
	$resposta = DaoUsuario::getInstance()->Deletar($user,$adm);

	if ($resposta == '1') {
		echo 'Usuário deletado!';
	} else {
		echo $resposta;
	}
} else {
	echo 'Erro no processo de envio.';
}