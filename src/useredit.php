<?php
include_once('usuario.php');
?>
<h1>Lista de Usuários</h1>
<div class="menubutton">
	<button class="enviar">Novo usuário</button>
</div>
<table cellspacing=0 class="tableresposta listausuario">
	<thead>
		<tr>
			<td>Id</td>
			<td>Nome</td>
			<td>Usuário</td>
			<td>Último Acesso</td>
		</tr>
	</thead>
	<tbody>
	<?php
		$usuarios = DaoUsuario::getInstance()->getListUsuarios();
		foreach ($usuarios as $u) {
			echo '<tr ';
			if ($u['adm'] == 1) {
				echo 'style="background-color:orange;"';
			}elseif ($u['adm'] == 2) {
				echo 'style="background-color:#AAAAAA;"';
			}
			echo ' value="' . $u['id_usuario'] . '">';
			echo '<td>' . $u['id_usuario'] . '</td>';
			echo '<td>' . $u['nome'] . '</td>';
			echo '<td>' . $u['usuario'] . '</td>';
			echo '<td>' . date_format(date_create($u['ult_acesso']),'d/m/Y H:i:s') . '</td>';
			echo '</tr>';
		}
	?>
	</tbody>
</table>
<div class="dadosresposta"></div>