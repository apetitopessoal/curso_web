<?php

	class Usuario{

		private $id;
		private $nome;
		private $email;
		private $senha;

		public function __constructor(){

		}


		public static function Adicionar($dados){

			if(is_array($dados)){
				if(!empty($dados["nome"]) && !empty($dados["email"])  && !empty($dados["senha"])){

					$sql = "insert into usuarios (nome,email,senha) values ('".$dados['nome']."','".$dados['email']."','".md5($dados['senha'])."')";
                    $ConexaoObj = new Conexao();                    
					$ConexaoObj->ExecutarQuery($sql);
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
        
	}
?>