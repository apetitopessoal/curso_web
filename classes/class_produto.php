<?php

	class Produto{

		public $id;
		public $nome;
		public $descricao;
		public $valor;
        public $foto;

		public function __construct($id){
            if(is_numeric($id)){
                $sql = "select id, nome, descricao, valor from produtos where id = ".$id;
                $ConexaoObj = new Conexao();                    
                $resposta = $ConexaoObj->ExecutarQuery($sql);
                if($resposta->num_rows > 0){
                    $resposta       = mysqli_fetch_assoc($resposta);
                    $this->id       = $resposta["id"];
                    $this->nome     = $resposta["nome"];
                    $this->descricao= $resposta["descricao"];
                    $this->valor    = $resposta["valor"];
                    $this->foto     = PATH_IMAGEM_PRODUTO."/".$resposta["id"].".jpg";
                }
            }    
		}


        public static function UploadFoto($arquivo,$produto_id){
            if(is_array($arquivo) && is_numeric($produto_id) && !empty($arquivo["tmp_name"])){                       
                if(!move_uploaded_file($arquivo["tmp_name"], PATH_IMAGEM_PRODUTO."/".$produto_id.".jpg")){
                    $_SESSION["error_msg"] = "Erro no upload de arquivo!";
                }
            }
        }
        
        
		public static function Adicionar($dados,$arquivo){

			if(is_array($dados)){
				if(!empty($dados["nome"]) && !empty($dados["descricao"])  && !empty($dados["valor"])){
					$sql = "insert into produtos (nome,descricao,valor) values ('".$dados['nome']."','".$dados['descricao']."','".$dados['valor']."')";
                    $ConexaoObj = new Conexao();                    
					$produto_id = $ConexaoObj->ExecutarQuery($sql);
                    self::UploadFoto($arquivo, $produto_id);                    
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
				if(!empty($dados["nome"]) && $dados["descricao"] && $dados["valor"]){					
                    $sql = "update produtos set nome = '".$dados["nome"]."', descricao = '".$dados["descricao"]."', valor='".$dados["valor"]."' where id = ".$dados["id"];
                    $ConexaoObj = new Conexao();                    
					$ConexaoObj->ExecutarQuery($sql);
                    self::UploadFoto($arquivo, $dados["id"]);                    
                    return true;
				}else{
					return false;
				}
			}else{
				return false;
			}

		}

        
        public static function ListarProdutos($pagina=1){
            
            $sql = "select id, nome from produtos order by nome";
            $ConexaoObj = new Conexao();                    
            return $ConexaoObj->ExecutarQuery($sql);
            
        }
        
        
        public static function Delete($id){
            
            if(is_numeric($id)){
                
                $sql = "delete from produtos where id = ".$id;
                $ConexaoObj = new Conexao();                    
                $resposta = $ConexaoObj->ExecutarQuery($sql);
                
                // Apagar arquivo de imagem
                unlink(PATH_IMAGEM_PRODUTO."/".$id.".jpg");
                
            }
            
            
        }
        
        
	}
?>