<?php 

$pasta = "../tmp/"; 
/* formatos de arquivo permitidos */ 
$permitidos = array(".txt"); 
if(!empty($_FILES['contatos'])){ 
	$nome_arquivo = $_FILES['contatos']['name']; 
	$tamanho_arquivo = $_FILES['contatos']['size']; 
	/* pega a extensão do arquivo */ 
	$ext = strtolower(strrchr($nome_arquivo,".")); 
	/* verifica se a extensão está entre as extensões permitidas */ 
	if(in_array($ext,$permitidos)){ 
		/* converte o tamanho para KB */ 
		$tamanho = round($tamanho_arquivo / 1024); 
		if($tamanho < 1024){ //se arquivo for até 1MB envia 
			$nome_atual = 'contatos.txt'; //md5(uniqid(time())).$ext; //nome que dará a arquivo 
			$tmp = $_FILES['contatos']['tmp_name']; //caminho temporário da arquivo 
			if(move_uploaded_file($tmp,$pasta.$nome_atual)){ 
				//echo "Arquivo enviado com sucesso!"; 
			} else { 
				echo "Falha ao enviar"; 
			} 
		} else { 
			echo "A arquivo deve ser de no máximo 1MB"; 
		} 
	} else { 
		echo "Somente são aceitos arquivos do tipo .txt"; 
	} 
} else { 
	echo "Selecione um arquivo .txt"; 
	exit; 
}

