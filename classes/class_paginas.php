<?php

	class Paginas{

		private $id;
		private $titulo;
		private $conteudo;

		public function __constructor(){

		}


		public static function Adicionar($dados){

			if(is_array($dados)){
				if(!empty($dados["titulo"]) && !empty($dados["conteudo"])){

					$sql = "insert into paginas (titulo,conteudo) values ('".$dados['titulo']."','".$dados['conteudo']."')";
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
            
            $sql = "select id, titulo from paginas order by titulo";
            $ConexaoObj = new Conexao();                    
            return $ConexaoObj->ExecutarQuery($sql);
            
        }
        
	}
?>