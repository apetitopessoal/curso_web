<?php

class Conexao{
    
    private $usuario;
    private $banco;
    private $host;
    private $senha;
    private $link;

    public function ExecutarQuery($sql) {
        
        $this->usuario  = DB_USUARIO;
        $this->banco    = DB_BANCO;
        $this->host     = DB_HOST;
        $this->senha    = DB_SENHA;        
        $this->link     = mysqli_connect($this->host, $this->usuario, $this->senha, $this->banco);

        if (mysqli_connect_errno()) {
            printf("Erro de Conexão: %s\n", mysqli_connect_error());
            exit();
        }else{            
            
            if ($result = mysqli_query($this->link, $sql)) {                
                if(strpos($sql, "select") !== false){
                    return $result;
                }elseif(strpos($sql,"insert") !== false){
                    return mysqli_insert_id($this->link);
                }                
                
            }
        }
        
    }
    
    
}

?>
