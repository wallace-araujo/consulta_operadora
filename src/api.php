<?php
session_start();
error_reporting(false);
function getParametros($numero,$url,$name,$api) {
	$url = $url;
    $data = array('tipo' => 'consulta', $name => $numero );

	$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4922)';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);    
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    $returndata = curl_exec($ch);
    curl_close($ch);
    $pagina = $returndata ;
    $pagina = str_replace('href="/', 'href="http://qualoperadora.info/', $pagina);
    $pagina = str_replace('src="/j', 'src="http://qualoperadora.info/j', $pagina);
    $params = array();

    switch ($api) {
        case 1:
            $operadora = explode('alt="', $pagina)[1];
            $operadora = explode('" title', $operadora)[0];
            $params['operadora'] = $operadora;

            $portado = explode('Portabilidade <span>&raquo;</span></span> ', $pagina)[1];
            $portado = explode('</p>', $portado)[0];
            $params['portado'] = substr($portado, 0,1);

            $numero = explode('class="tel">', $pagina)[1];
            $numero = explode('</div>', $numero)[0];
            $params['numero'] = $numero;

            $tipo = explode('Tipo <span>&raquo;</span></span> ', $pagina)[1];
            $tipo = explode('</p>', $tipo)[0];
            $params['tipo'] = $tipo;

            $estado = explode('Estado <span>&raquo;</span></span> ', $pagina)[1];
            $estado = explode('</p>', $estado)[0];
            $params['estado'] = $estado;

            $cidade = explode('o <span>&raquo;</span></span> ', $pagina)[3];
            $cidade = explode('</p>', $cidade)[0];
            $params['cidade'] = $cidade;

            if ($cidade == '') {
                $cidade = explode('Cidade <span>&raquo;</span></span> ', $pagina)[1];
                $cidade = explode('</p>', $cidade)[0];
                $params['cidade'] = $cidade;
            }
            break;

        case 2:
            $operadora = explode('alt="', $pagina)[1];
            $operadora = explode('" title', $operadora)[0];
            $params['operadora'] = $operadora;

            $numero = explode('<span class="t">', $pagina)[1];
            $numero = explode('</span>', $numero)[0];
            $params['numero'] = $numero;

            $params['portado'] = '-';
            $params['tipo'] = '-';
            $params['estado'] = '-';
            $params['cidade'] = '-';
            break;

        case 3:
            $operadora = explode(">: ", $pagina)[1];
            $operadora = explode('</span>', $operadora)[0];
            $params['operadora'] = $operadora;

            $portado = explode("portado </span> <span class='verde'>: ", $pagina)[1];
            $portado = explode('</span>', $portado)[0];
            $params['portado'] = $portado;

            $numero = explode('title="DDD + Numero" value="', $pagina)[1];
            $numero = explode('">', $numero)[0];
            $params['numero'] = $numero;

            $params['tipo'] = '-';
            $params['estado'] = '-';
            $params['cidade'] = '-';
            break;

        case 4:
            $operadora = explode('Operadora:</span><span class="lead laranja"> ', $pagina)[1];
            $operadora = explode('</span>', $operadora)[0];
            $params['operadora'] = utf8_encode($operadora);

            $portado = explode('Portado:</span><span class="lead laranja"> ', $pagina)[1];
            $portado = explode('</span>', $portado)[0];
            $params['portado'] = $portado;

            $numero = explode('mero:</span><span class="lead laranja"> ', $pagina)[1];
            $numero = explode('</span>', $numero)[0];
            $params['numero'] = $numero;

            $params['tipo'] = '-';
            $params['estado'] = '-';
            $params['cidade'] = '-';
            break;
    }


    $params['resposta'] = 'ok';

    return $params;
}

$retorno = array();
$flag = 0;

if ((!empty($_REQUEST['login']) && !empty($_REQUEST['senha'])) || isset($_SESSION['cnsopr'])) {

include_once('usuario.php');

$login = $_REQUEST['login'];
$senha = $_REQUEST['senha'];

$usuario = new Usuario();
$usuario->setUsuario($login);
$usuario->setSenha($senha);
$user = DaoUsuario::getInstance()->getUsuario($usuario, 1);

if ($user || isset($_SESSION['cnsopr'])) {

if (!empty($_REQUEST['numero'])) {
	$retorno = getParametros($_REQUEST['numero'],'http://consultanumero.info/consulta','tel',1); //API 1
	if ($retorno['numero'] == '') {
        $retorno = getParametros($_REQUEST['numero'],'http://qualoperadora.info/widget/consulta','tel',2); //API 2
        if ($retorno['numero'] == '') {
            $retorno = getParametros($_REQUEST['numero'],'http://www.qual-operadora.net/','numero',3); //API 3
            if ($retorno['numero'] == '') {
                do {
                    $retorno = getParametros($_GET['numero'],'http://consultaoperadora.com.br/site2015/resposta.php','numero',4); //API 4
                } while (($retorno['numero'] == '')&&($flag < 3));

                if ($retorno['numero'] == '')
                    $retorno = array('numero'=>$_REQUEST['numero'],'resposta'=>'Número não encontrado');
            }
        }
	}
} elseif (count($contato) > 1) {
    $ret = array();
    for ($i=0; $i < count($contato); $i++) { 
        $flag = 0;
        $ret = getParametros($contato[$i],'http://consultanumero.info/consulta','tel',1); //API 1
        if ($ret['numero'] == '') {
            $ret = getParametros($contato[$i],'http://qualoperadora.info/widget/consulta','tel',2); //API 2
            if ($ret['numero'] == '') {
                $ret = getParametros($_REQUEST['numero'],'http://www.qual-operadora.net/','numero',3); //API 3
                if ($ret['numero'] == '') {
                    do {
                        $ret = getParametros($contato[$i],'http://consultaoperadora.com.br/site2015/resposta.php','numero',4); //API 4
                    } while (($ret['numero'] == '')&&($flag < 3));

                    if ($ret['numero'] == '')
                        $ret = array('numero'=>$contato[$i],'resposta'=>'Número não encontrado');
                }
            }
        }
        array_push($retorno, $ret);
    }
} else
    $retorno = array('numero'=>$_REQUEST['numero'],'resposta'=>'Dados necessários não fornecidos');

} else 
    $retorno = array('resposta'=>'Falha na autenticação.');

} else 
    $retorno = array('resposta'=>'É necessário fornecer login e senha.');

echo json_encode($retorno);
?>