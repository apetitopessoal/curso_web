<?php

	define("PASTA_SITE","/");
	define("SITE_URL","http://".$_SERVER["HTTP_HOST"].PASTA_SITE);
	define("CAMINHO_IMAGEM","/fotos");
	define("TITULO_SITE","Acerta Web Print - Rodrigo");		
	define("SITE_URL_ADMIN","http://".$_SERVER["HTTP_HOST"].PASTA_SITE."admin");
    define("PATH_COMPLETO_SITE",$_SERVER["DOCUMENT_ROOT"].PASTA_SITE);
    
    
    // Configurações de Banco
    define("DB_USUARIO","root");
    define("DB_BANCO","curso_web");
    define("DB_HOST","localhost");
    define("DB_SENHA","");

    define("PASTA_IMAGEM_USUARIO","uploads/usuario/");
    define("PATH_IMAGEM_USUARIO",PATH_COMPLETO_SITE.PASTA_IMAGEM_USUARIO);
    define("URL_IMAGEM_USUARIO",SITE_URL.PASTA_IMAGEM_USUARIO);
    
    define("PASTA_IMAGEM_PRODUTO","uploads/produto/");
    define("PATH_IMAGEM_PRODUTO",PATH_COMPLETO_SITE.PASTA_IMAGEM_PRODUTO);
    define("URL_IMAGEM_PRODUTO",SITE_URL.PASTA_IMAGEM_PRODUTO);
    
    
    // Includes
    include_once(PATH_COMPLETO_SITE."classes/class_conexao.php");
    include_once(PATH_COMPLETO_SITE."classes/class_usuario.php");
    include_once(PATH_COMPLETO_SITE."classes/class_paginas.php");
    include_once(PATH_COMPLETO_SITE."classes/class_produto.php");
?>