<?php 

include_once('mysql.php');

class Usuario { 
	private $id_usuario; 
	private $nome; 
	private $usuario; 
	private $senha; 
	private $ultacesso; 
	private $admin; 

	public function getId() { 
		return $this->id_usuario; 
	} 	
	public function setId($id) { 
		$this->id_usuario = $id; 
	} 
	public function getNome() { 
		return $this->nome; 
	} 	
	public function setNome($nome) { 
		$this->nome = $nome; 
	} 
	public function getUsuario() { 
		return $this->usuario; 
	} 	
	public function setUsuario($usuario) { 
		$this->usuario = $usuario; 
	} 
	public function getSenha() { 
		return $this->senha; 
	} 	
	public function setSenha($senha) { 
		$this->senha = md5($senha); 
	} 
	public function getUltacesso() { 
		return $this->ultacesso; 
	} 	
	public function setUltacesso($ultacesso) { 
		$this->ultacesso = $ultacesso; 
	} 
	public function getAdmin() { 
		return $this->admin; 
	} 	
	public function setAdmin($admin) { 
		$this->admin = $admin; 
	} 
}

class DaoUsuario { 
	public static $instance; 

	private function __construct() { 
		// 
	} 
	public static function getInstance() { 
		if (!isset(self::$instance)) self::$instance = new DaoUsuario(); 
		return self::$instance; 
	} 
	public function Inserir(Usuario $usuario, $adm) { 
		if ($adm == 1)
			try { 
				$sql = "INSERT INTO usuario ( nome, usuario, senha, ult_acesso, adm ) 
					VALUES ( :nome, :usuario, :senha, NOW(), :admin)"; 
				$p_sql = Conexao::getInstance()->prepare($sql); 
				$p_sql->bindValue(":nome", $usuario->getNome()); 
				$p_sql->bindValue(":usuario", $usuario->getUsuario());
				$p_sql->bindValue(":senha", $usuario->getSenha()); 
				$p_sql->bindValue(":admin", $usuario->getAdmin()); 
				return $p_sql->execute(); 
			} catch (Exception $e) { 
				if (strpos($e, '1062') > 0) {
					print "Este login de acesso já existe. Tente outro.";
				} else 
					print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde."; 
			} 
		else
			print "É necessário ser administrador para esta operação.";
	}
	public function updateUsuario(Usuario $usuario, $adm) { 
		if ($adm == 1)
			try { 
				$sql = "UPDATE usuario SET nome = :nome, usuario = :usuario, senha = :senha, adm = :admin WHERE id_usuario = " . $usuario->getId(); 
				$p_sql = Conexao::getInstance()->prepare($sql); 
				$p_sql->bindValue(":nome", $usuario->getNome()); 
				$p_sql->bindValue(":usuario", $usuario->getUsuario());
				$p_sql->bindValue(":senha", $usuario->getSenha()); 
				$p_sql->bindValue(":admin", $usuario->getAdmin()); 
				return $p_sql->execute(); 
			} catch (Exception $e) { 
				if (strpos($e, '1062') > 0) {
					print "Este login de acesso já existe. Tente outro.";
				} else 
					print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde."; 
			} 
		else
			print "É necessário ser administrador para esta operação.";
	}
	public function getUsuario(Usuario $usuario, $api = 0) { 
		try { 
			if ($usuario->getId() > 0)
				$sql = "SELECT id_usuario, nome, usuario, ult_acesso, adm FROM usuario WHERE id_usuario = " . $usuario->getId() . " LIMIT 1"; 
			elseif ($api == 0)
				$sql = "SELECT id_usuario, nome, adm FROM usuario WHERE usuario like '" . $usuario->getUsuario() . "' and senha like '" . $usuario->getSenha() . "' AND adm < 2 LIMIT 1"; 
			else
				$sql = "SELECT id_usuario, nome, adm FROM usuario WHERE usuario like '" . $usuario->getUsuario() . "' and senha like '" . $usuario->getSenha() . "' LIMIT 1"; 
			$p_sql = Conexao::getInstance()->prepare($sql); 
			$p_sql->execute(); 
			$lista = $p_sql->fetch(PDO::FETCH_ASSOC);
			return $lista;
		} catch (Exception $e) { 
			print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde."; 
		} 
	}
	public function getListUsuarios() { 
		try { 
			$sql = "SELECT id_usuario, nome, usuario, ult_acesso, adm FROM usuario"; 
			$p_sql = Conexao::getInstance()->prepare($sql); 
			$p_sql->execute(); 
			$lista = $p_sql->fetchAll(PDO::FETCH_ASSOC);
			return $lista;
		} catch (Exception $e) { 
			print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde."; 
		} 
	}
	public function updateAcesso(Usuario $usuario) { 
		try { 
			$sql = "UPDATE usuario SET ult_acesso = NOW() WHERE id_usuario = " . $usuario->getId(); 
			$p_sql = Conexao::getInstance()->prepare($sql); 
			return $p_sql->execute(); 
		} catch (Exception $e) { 
			print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde."; 
		} 
	}
	public function Deletar(Usuario $usuario, $adm) { 
		if ($adm == 1)
			try { 
				$sql = "DELETE FROM usuario WHERE id_usuario = " . $usuario->getId(); 
				$p_sql = Conexao::getInstance()->prepare($sql); 
				return $p_sql->execute(); 
			} catch (Exception $e) { 
				print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde."; 
			} 
		else
			print "É necessário ser administrador para esta operação.";
	}
}
?>