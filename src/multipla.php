<h1>Consulta Múltipla</h1>
<div class="menubutton">
	<button class="enviar">Consultar</button>
	<button class="export" id="btnExport">Exportar</button>
	<form id="formulario" method="post" enctype="multipart/form-data">	
		<input class="file" id="contatos" name="contatos" type="file" />
	</form>
</div>
<table id="tblExport" class="tableresposta" cellspacing=0>
	<thead>
		<tr>
			<th>Número</th>
			<th>Operadora</th>
			<th>Tipo</th>
			<th>Cidade</th>
			<th>Estado</th>
			<th>Portado</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
	<tfoot>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tfoot>
</table>
<div class="dadosresposta"></div>