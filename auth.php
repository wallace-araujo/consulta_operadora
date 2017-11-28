<?php
session_start();

include_once('src/usuario.php');

if (!empty($_POST['login']) && !empty($_POST['senha'])) {
	$login = $_POST['login'];
	$senha = $_POST['senha'];

	$usuario = new Usuario();
	$usuario->setUsuario($login);
	$usuario->setSenha($senha);
	
	$user = DaoUsuario::getInstance()->getUsuario($usuario);

	if ($user) {
		$_SESSION["cnsopr"] = $user['nome'];
		$_SESSION["cnsopr__"] = $user['id_usuario'];
		$_SESSION["cnsopr_"] = $user['adm'];
		$usuario->setId($user['id_usuario']);
		DaoUsuario::getInstance()->updateAcesso($usuario);
		$redirect = $_SERVER['HOST'] . ".";
		header("location:$redirect");
	} else {
		$redirect = $_SERVER['HOST'] . "login.php?e=bs2g4";
		header("location:$redirect");
	}
} else {
	$redirect = $_SERVER['HOST'] . "login.php?e=a18h3";
	header("location:$redirect");
}