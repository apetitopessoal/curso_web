<?php

	class Paginas{

		public $id;
		public $titulo;
		public $conteudo;
        public $url;

		public function __construct($url){
            
            if(is_string($url)){
                
                $sql = "select * from paginas where url = '".$url."'";
                $ConexaoObj = new Conexao();                    
                $resposta   = $ConexaoObj->ExecutarQuery($sql);
                if($resposta->num_rows > 0){
                    $resposta       = mysqli_fetch_assoc($resposta);
                    $this->id       = $resposta["id"];
                    $this->titulo   = $resposta["titulo"];
                    $this->conteudo = $resposta["conteudo"];                    
                    $this->url      = $resposta["url"];
                }
            }
            
            

		}


		public static function Adicionar($dados){

			if(is_array($dados)){
				if(!empty($dados["titulo"]) && !empty($dados["conteudo"])){
                    $url = preg_replace("/[^a-zA-Z0-9]+/", "-", strtolower($dados["titulo"]));
					$sql = "insert into paginas (titulo,conteudo,url) values ('".$dados['titulo']."','".$dados['conteudo']."','".$dados["titulo"]."')";
                    $ConexaoObj = new Conexao();                    
					return $ConexaoObj->ExecutarQuery($sql);

				}else{
					return false;
				}
			}else{
				return false;
			}

		}

        
        public static function ListarPaginas($pagina=1){
            
            $sql = "select id, titulo, url from paginas order by titulo";
            $ConexaoObj = new Conexao();                    
            return $ConexaoObj->ExecutarQuery($sql);
            
        }
        
	}
?>