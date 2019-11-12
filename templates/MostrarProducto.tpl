{include 'templates/header.tpl'}  
<div class="container">
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

<div class="container">
     <h2> aca van a ir los comentarios <h2>
</div>
{include 'templates/footer.tpl'} 