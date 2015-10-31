<?php

	class Usuario{

		public $id;
		public $nome;
		public $email;
		public $senha;
        public $foto;

		public function __construct($id){
            if(is_numeric($id)){
                $sql = "select id, nome, email, senha from usuarios where id = ".$id;
                $ConexaoObj = new Conexao();                    
                $resposta = $ConexaoObj->ExecutarQuery($sql);
                if($resposta->num_rows > 0){
                    $resposta       = mysqli_fetch_assoc($resposta);
                    $this->id       = $resposta["id"];
                    $this->nome     = $resposta["nome"];
                    $this->email    = $resposta["email"];
                    $this->senha    = $resposta["senha"];
                    $this->foto     = URL_IMAGEM_USUARIO."/".$resposta["id"].".jpg";
                }
            }    
		}


        public static function UploadFoto($arquivo,$usuario_id){
            if(is_array($arquivo) && is_numeric($usuario_id) && !empty($arquivo["tmp_name"])){                       
                if(!move_uploaded_file($arquivo["tmp_name"], PATH_IMAGEM_USUARIO."/".$usuario_id.".jpg")){
                    $_SESSION["error_msg"] = "Erro no upload de arquivo!";
                }
            }
        }
        
        
		public static function Adicionar($dados,$arquivo){

			if(is_array($dados)){
				if(!empty($dados["nome"]) && !empty($dados["email"])  && !empty($dados["senha"])){
					$sql = "insert into usuarios (nome,email,senha) values ('".$dados['nome']."','".$dados['email']."','".md5($dados['senha'])."')";
                    $ConexaoObj = new Conexao();                    
					$usuario_id = $ConexaoObj->ExecutarQuery($sql);
                    self::UploadFoto($arquivo, $usuario_id);                    
                    return true;
				}else{
					return false;
				}
			}else{
				return false;
			}

		}
        
        
        public static function Editar($dados,$arquivo){

			if(is_array($dados)){
				if(!empty($dados["nome"]) && $dados["id"]){					
                    $sql = "update usuarios set nome = '".$dados["nome"]."' where id = ".$dados["id"];
                    $ConexaoObj = new Conexao();                    
					$usuario_id = $ConexaoObj->ExecutarQuery($sql);
                    self::UploadFoto($arquivo, $dados["id"]);                    
                    return true;
				}else{
					return false;
				}
			}else{
				return false;
			}

		}

        
        public static function ListarUsuarios($pagina=1){
            
            $sql = "select id, email, nome from usuarios order by nome";
            $ConexaoObj = new Conexao();                    
            return $ConexaoObj->ExecutarQuery($sql);
            
        }
        
        public static function Login($usuario, $senha){
            if(filter_var($usuario, FILTER_VALIDATE_EMAIL) && ctype_alnum($senha)){
                $sql = "select id,nome,email from usuarios where email = '".$usuario."' and senha = '".md5($senha)."'";
                $ConexaoObj = new Conexao();                    
                $resposta = $ConexaoObj->ExecutarQuery($sql);
                if($resposta->num_rows > 0){
                    $resposta = mysqli_fetch_assoc($resposta);
                    $_SESSION["id"]     = $resposta["id"];
                    $_SESSION["nome"]   = $resposta["nome"];
                    $_SESSION["email"]  = $resposta["email"];
                    $_SESSION["hash"]   = md5($resposta["id"].$resposta["nome"].$resposta["email"]);
                    
                    // Verificar se existe imagem de usuario
                    if(file_exists(PATH_IMAGEM_USUARIO.$resposta["id"].".jpg")){
                        $_SESSION["imagem"] = URL_IMAGEM_USUARIO.$resposta["id"].".jpg";
                    }else{
                        $_SESSION["imagem"] = '';
                    }
                    
                    return true;    
                }else{
                    return false;
                }                
            }else{
                return false;
            }
        }
        
        public static function ValidarLogin(){                       
            if(filter_var($_SESSION["email"], FILTER_VALIDATE_EMAIL) && !empty($_SESSION["nome"]) && is_numeric($_SESSION["id"])){                
                $sql = "select id, nome, email from usuarios where email = '".$_SESSION["email"]."' and nome='".$_SESSION["nome"]."' and id = ".$_SESSION["id"];
                $ConexaoObj = new Conexao();                    
                $resposta = $ConexaoObj->ExecutarQuery($sql);
                if($resposta->num_rows > 0){
                    $resposta = mysqli_fetch_assoc($resposta);
                    if($_SESSION["hash"]  == md5($resposta["id"].$resposta["nome"].$resposta["email"])){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }                
            }else{
                return false;
            }           
            
        }
        
        
        public static function Delete($id){
            
            if(is_numeric($id)){
                
                $sql = "delete from usuarios where id = ".$id;
                $ConexaoObj = new Conexao();                    
                $resposta = $ConexaoObj->ExecutarQuery($sql);
                
                // Apagar arquivo de imagem
                unlink(PATH_IMAGEM_USUARIO."/".$id.".jpg");
                
            }
            
            
        }
        
        
	}
?>