<?php
session_start();
$adm = $_SESSION['cnsopr_'];
?>
<h1>Cadastro de Novo Usuário</h1>
<div class="menubutton">
	<button class="enviar">Enviar</button>
</div>
<form id="newuser">
	<input type="hidden" name="adm" value="<?php echo $adm; ?>">
	<label>Nome:</label><br>
	<input class="inputuser" name="nome" require placeholder="Nome do usuário"><br><br>
	<label>Usuário:</label><br>
	<input class="inputuser" name="usuario" require placeholder="Login de acesso"><br><br>
	<label>Senha:</label><br>
	<input class="inputuser" name="senha" require type="password" placeholder="Senha de acesso"><br><br>
	<label>Confirma Senha:</label><br>
	<input class="inputuser" name="confsenha" require type="password" placeholder="Confirmar senha de acesso"><br><br>
	<label>Tipo:</label><br>
	<select class="inputuser" name="admin">
		<option value="0" selected>Usuário</option>
		<option value="1">Administrador</option>
		<option value="2">API</option>
	</select>
</form>
<div class="dadosresposta"></div>