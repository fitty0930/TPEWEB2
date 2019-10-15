<?php
  require('libs/Smarty.class.php');
    class CategoriaView {

        function Mostrar($TituloC, $Categorias){
            $smarty = new Smarty();
            $smarty->assign('Titulo',$TituloC); // el titulo del assign puede ser cualquier valor
            $smarty->assign('Categorias',$Categorias);
            $smarty->display('templates/editarproducto.tpl'); 
        
        ?>
        
        
        <?php
        }
    }
    
    
    
?>