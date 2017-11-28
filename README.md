
<h3>Nome do Projeto: Consulta Operadora e Portabilidade</h3>
<br>
Descrição: O projeto consiste em um sistema que captura, de 3 diferentes sites, dados de operadoras telefônicas para números específicados pelo usuário.
<br>Version: 2.0



<h3>ATENÇÃO</h3>
É NECESSÁRIO INSTALAR O BANCO DE DADOS QUE ARMAZENA DADOS DOS USUÁRIOS.
O ARQUIVO DE INSTALAÇÃO DO BANCO DE DADOS É O 'create_db.sql'.
<br><br>
APÓS A INSTALAÇÃO DO BANCO DE DADOS, ALTERE AS INFORMAÇÕES DO ARQUIVO 'src/mysql.php'.
NESTE ARQUIVO É ESPECIFICADO OS DADOS DE ACESSO AO BD (USUÁRIO, SENHA, NOME DO BANCO, ...).



<h3>LOGIN E SENHA PADRÃO</h3>
Login: admin<br>
Senha: 123
<br>

<h3> Informação que você irá obter do telefone</h3>
<b>Número:</b> (11) 90000 0070<br>
<b>Operadora:</b> Claro<br>
<b>Tipo:</b> Celular<br>
<b>Cidade:</b> São Paulo e região metropolitana<br>
<b>Estado:</b> São Paulo (SP)<br><br>
<b>Portado:</b> N<br>



<h3>MODELO DA UTILIZAÇÃO DA API</h3>
<br>
<code>www.seudominio.com.br/src/api.php?numero=11900000000&login=admin&senha=123</code>

