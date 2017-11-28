<html>
<head>
	<title>Consulta de Operadora</title>
	<link rel="shortcut icon" href="layout/icon.ico">
	<link rel="stylesheet" type="text/css" href="layout/css.css">
	<script type="text/javascript" src="functions/jquery.js"></script>
	<script type="text/javascript" src="functions/jquery.form.min.js"></script>
</head>
<body>
	<table class="principal" cellspacing=0>
		<thead>
			<tr>
				<td colspan=2>
					<div class="title">
						<h1>Consulta</h1>
						<h1 class="sub_h1">Operadora</h1>
					</div>
				</td>
			</tr>
		</thead>
		<tbody class="login">
			<tr>
				<td class="content">
					<form class="auth" method="post" action="auth.php">
						<div class="user"></div>
						<label>Usuário</label><br>
						<input class="login" name="login"><br><br>
						<label>Senha</label><br>
						<input class="senha" type="password" name="senha"><br><br>
						<input type="submit" class="button" value="Entrar">
						<div class="erro">
							<?php  
							if (!empty($_GET['e'])) {
								switch ($_GET['e']) {
									case 'a18h3':
										echo 'Informe o seu nome de usuário e senha.';
										break;
									case 'bs2g4':
										echo 'Usuário e/ou senha incorreta.';
										break;
								}
							}
							?>
						</div>
					</form>
				</td>
				<td class="content">
					<div class="data">
						<?php
							date_default_timezone_set('America/Sao_Paulo');
							$dia = date('d');
							$mes = date('m');
							$ano = date('Y');
							$semana = date('w');
							switch ($mes){
							case 1: $mes = "Janeiro"; break;
							case 2: $mes = "Fevereiro"; break;
							case 3: $mes = "Março"; break;
							case 4: $mes = "Abril"; break;
							case 5: $mes = "Maio"; break;
							case 6: $mes = "Junho"; break;
							case 7: $mes = "Julho"; break;
							case 8: $mes = "Agosto"; break;
							case 9: $mes = "Setembro"; break;
							case 10: $mes = "Outubro"; break;
							case 11: $mes = "Novembro"; break;
							case 12: $mes = "Dezembro"; break;
							}
							switch ($semana) {
							case 0: $semana = "Domingo"; break;
							case 1: $semana = "Segunda Feira"; break;
							case 2: $semana = "Terça Feira"; break;
							case 3: $semana = "Quarta Feira"; break;
							case 4: $semana = "Quinta Feira"; break;
							case 5: $semana = "Sexta Feira"; break;
							case 6: $semana = "Sábado"; break;
							}
							echo ("$semana, $dia de $mes de $ano");
						?>
					</div>
					<div class="hora">
						<?php
							echo date('H:i');
						?>
					</div>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan=2>
					Consulta Operadora
				</td>
			</tr>
		</tfoot>
	</table>
</body>
</html>