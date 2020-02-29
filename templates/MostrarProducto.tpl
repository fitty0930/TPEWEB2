{include 'templates/header.tpl'}  
<div class="container" data-id_producto = "{$producto->id_producto}">
     {if $admin}
     <h3> <a href="edicionproducto/{$producto->id_producto}"> {$producto->producto} </a> </h3>
     {else}
     <h3> <p> {$producto->producto} </p> </h3>
     {/if}
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
<div class="container">
     <div class="col-md-12">
     <input hidden disabled value="{$producto->id_producto}" type="text" class="id_producto"> 
     {if $imagenes}
        {if $admin}
        <br>
        <a href="borrarTodoImg/{$producto->id_producto}" class="badge badge-danger text-wrap" style="width: 6rem;"> Borrar todas las imagenes </a>
        
        {/if}
     {/if}
          <div class="col-md-12">
          <ul class="list-group">
               {foreach from=$imagenes item=imagen}
                    <li class="list-group-item">
                    {if $admin}
                         <a href="borrarImg/{$imagen->id_imagen}"class="badge badge-danger text-wrap" style="width: 6rem;" >Borrar imagen</a> <br> 
                         
                    {/if}
                    
                    <img  class="img-reduc img-fluid img-reduct img-thumbnail" src="{$imagen->ruta}" class="img-responsive d-block w-100 h-100" alt="img">
                    </li>
               {/foreach}
               
          </ul>
          </div>
     <div>
</div>

<div class="container">
     <div class="col-md-12">
          {include 'vue/sectorComentarios.tpl'}
     </div>
</div>
{* mi js *}
<script src="js/comentarios.js"></script>
{include 'templates/footer.tpl'} 