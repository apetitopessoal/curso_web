function redimensionarImage() {			
	var ratio = 8/5;
	var width = window.innerWidth, pWidth, height = window.innerHeight, pHeight;
	if (width / ratio < height) {
		pWidth = Math.ceil(height * ratio);
        
        if (typeof jQuery == 'undefined') {
            document.getElementByClass("imagem_principal").width  = pWidth;
            document.getElementByClass("imagem_principal").height = height;
            document.getElementByClass("imagem_principal").style.marginLeft = (width - pWidth) / 2;                
            document.getElementByClass("imagem_principal").style.top = 0;
            document.getElementByClass("imagem_principal").style.float = 'left';
        }else{ 
            $(".imagem_principal").width(pWidth).height(height).css({
                "margin-left": (width - pWidth) / 2, 
                "top": 0
            });
        }
	} else {
        pHeight = Math.ceil(width / ratio);
        if (typeof jQuery == 'undefined') {                   
            document.getElementByClass("imagem_principal").height = pHeight;
            document.getElementByClass("imagem_principal").style.marginLeft = 0;
            document.getElementByClass("imagem_principal").style.top  = (height - pHeight) / 2;
        }else{
            $(".imagem_principal").width(width).height(pHeight).css({
                "left": 0, 
                "top": (height - pHeight) / 2,
                "margin-left":0
            });
        }                
	}
	
}

function posicaoRodape() {
       
    RodapeAltura = $(".rodape").height();
    RodapeTop = ($(window).scrollTop()+$(window).height()-RodapeAltura)+"px";
   
    if ( ($(document.body).height()+RodapeAltura) < $(window).height()) {
    	$(".rodape").css({
  			position: "absolute"
       	}).animate({
        	top: RodapeTop
        })
    } else {
    	$(".rodape").css({
        	position: "static"
        })
    };

    
           
}



$(document).ready(function(){

	$(".fancybox").fancybox();
	posicaoRodape();
	redimensionarImage();
	$('.conteudo').css('height', window.innerHeight-150);
		
	$( window ).resize(function() {
		posicaoRodape();
		redimensionarImage();
		$('.conteudo').css('height', window.innerHeight-150); 	
	});

	/*
	$('.cabecalho').click(function() {	
		$.ajax({						
		  	url: "conteudo_ajax.html"
		}).done(function( retorno ) {
		    $( ".conteudo" ).html( retorno );
	  	});
	});
	*/
	
		
});