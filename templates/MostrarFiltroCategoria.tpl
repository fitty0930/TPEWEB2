{include 'templates/header.tpl'}  
   <div class="container">
    <h3> {$categoria->nombre} </h3>
        
    <ul class="list-group">
        {foreach $productoporcategorias as $productoporcategoria }
            <li class="list-group-item">
                <a href="productos/{$productoporcategoria->id_producto} ">{* modif  *}
                {$productoporcategoria->producto}</a>
            </li>
        {/foreach}
    </ul>
    </div>
{include 'templates/footer.tpl'} 