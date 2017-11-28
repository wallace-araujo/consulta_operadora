function getDados (numero) {
	$('.content .dadosresposta').html('');
	$('.content .dadosresposta').css("background-image","url(layout/carregando.gif)");
	numero = numero.replace(/[^0-9]/g, '');
	$.ajax({
		url: "src/api.php?numero="+numero
	})
	.done(function( data ) {
		$('.content .dadosresposta').css("background-image","");
		var data = $.parseJSON(data);
		var html = '';
		if (data.resposta != 'ok') {
			html = '<b>'+data.resposta+'</b>';
		} else {
			html += '<b>Número: </b>'+data.numero+'<br>';
			html += '<b>Operadora: </b>'+data.operadora+'<br>';
			html += '<b>Tipo: </b>'+data.tipo+'<br>';
			html += '<b>Cidade: </b>'+data.cidade+'<br>';
			html += '<b>Estado: </b>'+data.estado+'<br>';
			html += '<b>Portado: </b>'+data.portado;
		}
		$('.content .dadosresposta').html(html);
	});
}
function getDadosMultiplos () {
	$('.content .tableresposta tbody').html('');
	$('.content .dadosresposta').css("background-image","url(layout/carregando.gif)");
	$.ajax({
		url: "src/readtxt.php"
	})
	.done(function( data ) {
		$('.content .dadosresposta').css("background-image","");
		var data = $.parseJSON(data);
		var html = '';
		for (var i = 0; i < data.length; i++) {
			$('.content .dadosresposta').html('');
			if (data[i].resposta != 'ok') {
				html = '<tr><td>'+data[i].numero+'</td><td colspan=5>'+data[i].resposta+'</td></tr>';
			} else {
				html += '<tr><td>'+data[i].numero+'</td>';
				html += '<td>'+data[i].operadora+'</td>';
				html += '<td>'+data[i].tipo+'</td>';
				html += '<td>'+data[i].cidade+'</td>';
				html += '<td>'+data[i].estado+'</td>';
				html += '<td>'+data[i].portado+'</td></tr>';
			}
		}
		$('.content .tableresposta tbody').html(html);
	});
}
function getUnica () {
	$.ajax({
		url: "src/unica.php"
	})
	.done(function( msg ) {
		$('.content').html(msg);
		$('.content input').keydown(function (e) {
			if ($('.content input').val()[5] == '9') {
				$('.content input').setMask('(99) 99999-9999');
			} else {
				$('.content input').setMask('(99) 9999-9999');
			}
		});
		$('.content input').focus();
		$('.content input').keypress(function (e) {
			if (e.which == 13) {
				var numero = $('.content input').val();		
				getDados(numero);
			}
		});
		$('.content .enviar').click(function () {	
			var numero = $('.content input').val();		
			getDados(numero);
		});
	});
}
function getMultipla () {
	$.ajax({
		url: "src/multipla.php"
	})
	.done(function( msg ) {
		$('.content').html(msg);
		$('.content .enviar').click(function () {		
			$('#formulario').ajaxForm({
				target: '.content .dadosresposta', 
				url:	"src/uploadcontatos.php", 
				success: function() {
					getDadosMultiplos();
				}
			}).submit(); 	
		});
		$("#btnExport").click(function (e) {
			$("#tblExport").btechco_excelexport({
                containerid: "tblExport", 
                datatype: $datatype.Table, 
                filename: 'consultaoperadora'
            });
		});	
	});
}
function getUseradd () {
	$.ajax({
		url: "src/useradd.php"
	})
	.done(function( msg ) {
		$('.content').html(msg);
		$('.content .enviar').click(function () {	
			$.post("src/useraddenviar.php", 
				$('.content #newuser').serialize()
			)
			.done(function( msg ) {
				$('.content .dadosresposta').html(msg);
			});		
		});
	});
}
function getUseredit (id) {
	$.post("src/userupdate.php", {
		data: {id}
	})
	.done(function( msg ) {
		$('.content').html(msg);
		$('.content .enviar').click(function () {	
			$.post("src/useraddenviar.php", 
				$('.content #newuser').serialize()
			)
			.done(function( msg ) {
				$('.content .dadosresposta').html(msg);
			});		
		});
		$('.content .deletar').click(function () {	
			if (confirm('Deseja mesmo deletar este usuário?')) {
				$.post("src/userdelete.php", 
					$('.content #newuser').serialize()
				)
				.done(function( msg ) {
					$('.content .dadosresposta').html(msg);
				});		
			}
		});
	});
}
function userEdit () {
	$.ajax({
		url: "src/useredit.php"
	})
	.done(function( msg ) {
		$('.content').html(msg);
		$('.content .enviar').click(function () {	
			getUseradd();	
		});
		$('.listausuario tbody tr').click(function () {	
			getUseredit($(this).attr('value'));	
		});
	});
}

$(document).ready(function(){
	$('#unica').click(function () {
		getUnica();
	});
	getUnica();
	$('#multipla').click(function () {
		getMultipla();
	});
	$('#configuracao').click(function () {
		userEdit();
	});
});