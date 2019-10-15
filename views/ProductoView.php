<?php
  require('libs/Smarty.class.php');
    class ProductoView {

        function Mostrar($Titulo, $Productos){
            $smarty = new Smarty();
            $smarty->assign('titulo',$Titulo); // el titulo del assign puede ser cualquier valor
            $smarty->assign('Productos',$Productos);
            $smarty->display('templates/home.tpl');
        
        ?>
        
        
        <?php
        }
    }
    
    
    
?>