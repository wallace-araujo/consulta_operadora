<?php
session_start();
if (!isset($_SESSION['cnsopr'])) {
	$redirect = $_SERVER['HOST'] . "login.php";
	header("location:$redirect");
}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Consulta de Operadora</title>
	<link rel="shortcut icon" href="layout/icon.ico">
	<link rel="stylesheet" type="text/css" href="layout/css.css">
	<script type="text/javascript" src="functions/jquery.js"></script>
	<script type="text/javascript" src="functions/jquery.form.min.js"></script>
	<script type="text/javascript" src="functions/meiomask.js"></script>
	<script type="text/javascript" src="functions/jquery.base64.js"></script>
	<script type="text/javascript" src="functions/jquery.btechco.excelexport.js"></script>
	<script type="text/javascript" src="functions/js.js"></script>
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
					<div class="menutop">
						<div class="dadosuser"><?php echo 'Olá, ' . $_SESSION["cnsopr"]; ?></div>
						<div class="configuracao" id="configuracao"></div>
						<a href="logout.php"><div class="logout"></div></a>
					</div>
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="side">
					<h2>Menu</h2>
					<ul>
						<li id="unica">Consulta Única</li>
						<li id="multipla">Consulta Múltipla</li>
					</ul>
				</td>
				<td class="content"></td>
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