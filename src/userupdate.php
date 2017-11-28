<?php
session_start();
if (!empty($_POST['data'])) {
	include_once('usuario.php');
	$data = $_POST['data'];

	$user = new Usuario();
	$user->setId($data['id']);
	$adm = $_SESSION['cnsopr_'];
	$id = $_SESSION['cnsopr__'];
	if ($id == $data['id']) {
		$adm = 1;
	}
	
	$usuario = DaoUsuario::getInstance()->getUsuario($user);
?>
<h1>Atualizar Dados de Usuário</h1>
<div class="menubutton">
	<button class="enviar">Atualizar</button>
	<?php if ($usuario['usuario'] != 'admin') echo '<button class="enviar deletar">Deletar</button>'; ?>
</div>
<form id="newuser">
	<input type="hidden" name="adm" value="<?php echo $adm; ?>">
	<input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
	<label>Nome:</label><br>
	<input class="inputuser" name="nome" require placeholder="Nome do usuário" value="<?php echo $usuario['nome']; ?>"><br><br>
	<label>Usuário:</label><br>
	<input class="inputuser" name="usuario" require placeholder="Login de acesso" <?php if ($usuario['usuario'] == 'admin') echo 'readonly'; ?> value="<?php echo $usuario['usuario']; ?>"><br><br>
	<label>Senha:</label><br>
	<input class="inputuser" name="senha" require type="password" placeholder="Senha de acesso"><br><br>
	<label>Confirma Senha:</label><br>
	<input class="inputuser" name="confsenha" require type="password" placeholder="Confirmar senha de acesso"><br><br>
	<?php 
	if ($usuario['usuario'] != 'admin') {
	?>
	<label>Tipo:</label><br>
	<select class="inputuser" name="admin">
		<option value="0" <?php if ($usuario['adm'] == 1) echo 'selected'; ?>>Não</option>
		<option value="1" <?php if ($usuario['adm'] == 0) echo 'selected'; ?>>Sim</option>
		<option value="2" <?php if ($usuario['adm'] == 2) echo 'selected'; ?>>API</option>
	</select>
	<?php
	}
	?>
</form>
<div class="dadosresposta"></div>
<?php
} else {	
	$redirect = $_SERVER['HOST'] . ".";
	header("location:$redirect");
}
?>