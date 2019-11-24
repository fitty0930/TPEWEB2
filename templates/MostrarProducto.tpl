{include 'templates/header.tpl'}  
<div class="container" data-idproducto = "{$producto->id_producto}>
     <h3> {$producto->producto}  </h3>
          <ul class="list-group">    
               <li class="list-group-item">
                    Marca: {$producto->marca}
               </li>
               <li class="list-group-item">
                    Precio: {$producto->precio}
               </li>
               <li class="list-group-item">
                    Categoria: {$producto->id_categoria}
               </li>
          </ul>
</div>

<input hidden disabled value="{$producto->id_producto}" type="text" class="idproducto"> 
{*  *}
     {if $imagenes}
        {if $admin}
        <a href="borrarTodoImg/{$producto->id_producto}"> Borrar todas las imagenes </a>
        {* borrarTodoImg *}
        {/if}
     {/if}
<div class="col-12">
     <div>
          <ul>
               {foreach from=$imagenes item=imagen}
                    <li>
                    {if $admin}
                         <a href="borrarImg/{$imagen->id_imagen}">Borrar imagen</a> 
                         {* borrarImg *}
                    {/if}
                    
                    <img  class="img-reduc img-fluid img-reduct" width="350" src="{$imagen->ruta}" class="d-block w-100 h-100" alt="img">
                    </li>
               {/foreach}
               
          </ul>
     <div>
</div>

<div class="container">
     <div class="col-md-6">
          {include 'vue/sectorComentarios.tpl'}
     </div>
</div>
{include 'templates/footer.tpl'} 