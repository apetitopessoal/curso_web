<!-- **********************************************************************************************************************************************************
MAIN SIDEBAR MENU
*********************************************************************************************************************************************************** -->
<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <?php            
            if(!empty($_SESSION["imagem"])){
                ?>
                <p class="centered">
                    <a href="profile.html">
                        <img src="<?php echo $_SESSION["imagem"]?>" class="img-circle" width="60">
                    </a>
                </p>    
                <?php
            }?>
            
            <h5 class="centered">
                <?php echo $_SESSION["nome"]?>
            </h5>
            <li class="mt">
                <a <?php echo (strpos($_SERVER["REQUEST_URI"],"lista_pagina") ? "class='active'" : "")?> href="<?php echo SITE_URL_ADMIN?>/lista_pagina.php">
                    <i class="fa fa-dashboard"></i>
                    <span>
                        Páginas
                    </span>
                </a>
            </li>
            <li class="sub-menu">
                <a <?php echo (strpos($_SERVER["REQUEST_URI"],"lista_carros") ? "class='active'" : "")?>href="javascript:;" >
                    <i class="fa fa-desktop"></i>
                    <span>
                        Carros
                    </span>
                </a>                
            </li>
            <li class="sub-menu">
                <a <?php echo (strpos($_SERVER["REQUEST_URI"],"lista_usuarios") ? "class='active'" : "")?> href="<?php echo SITE_URL_ADMIN?>/lista_usuarios.php">
                    <i class="fa fa-desktop"></i>
                    <span>
                        Usuários
                    </span>
                </a>                
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->