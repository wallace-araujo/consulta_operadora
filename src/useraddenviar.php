<?php
session_start();

include_once('usuario.php');

if (count($_POST) == 6) {
	$nome = $_POST['nome'];
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	$confsenha = $_POST['confsenha'];
	$admin = $_POST['admin'];
	$adm = $_POST['adm'];

	if (($senha == '') || ($senha != $confsenha)) {
		echo 'As senhas informadas não coincidem.';
	} elseif ($nome == '') {
		echo 'O campo nome precisa ser preenchido.';
	} elseif ($usuario == '') {
		echo 'O campo usuário precisa ser preenchido.';
	} else {
		$user = new Usuario();
		$user->setNome($nome);
		$user->setUsuario($usuario);
		$user->setSenha($senha);
		$user->setAdmin($admin);
		
		$resposta = DaoUsuario::getInstance()->Inserir($user,$adm);

		if ($resposta == '1') {
			echo 'Usuário cadastrado!';
		} else {
			echo $resposta;
		}
	}
} elseif (count($_POST) == 7) {
	$id_usuario = $_POST['id_usuario'];
	$nome = $_POST['nome'];
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	$confsenha = $_POST['confsenha'];
	$adm = $_POST['adm'];
	$admin = $_POST['admin'];

	if (($senha == '') || ($senha != $confsenha)) {
		echo 'As senhas informadas não coincidem.';
	} elseif ($nome == '') {
		echo 'O campo nome precisa ser preenchido.';
	} elseif ($usuario == '') {
		echo 'O campo usuário precisa ser preenchido.';
	} else {
		$user = new Usuario();
		$user->setId($id_usuario);
		$user->setNome($nome);
		$user->setUsuario($usuario);
		$user->setSenha($senha);
		$user->setAdmin($admin);
		
		$resposta = DaoUsuario::getInstance()->updateUsuario($user,$adm);

		if ($resposta == '1') {
			echo 'Usuário atualizado!';
		} else {
			echo $resposta;
		}
	}
} else {
	echo 'Erro no processo de envio.';
}