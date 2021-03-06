{include 'templates/header.tpl'}  
    <div class="container">
    <h3> Categorias </h3>
        <ul class="list-group">
            {foreach $categorias as $categoria} 
                <li class="list-group-item">
                <a href="categorias/{$categoria->id_categoria}">{$categoria->nombre}</a>
                {if $admin}
                    --------
                    <a href="edicioncategoria/{$categoria->id_categoria}">Editar</a>|  
                    <a href="borrarcategoria/{$categoria->id_categoria}">Eliminar</a> 
                </li>
                {/if}
            {/foreach}
        </ul>

        {if $admin}
        <h2> Formulario de mantenimiento </h2>
        <div class="form-group">
            <form action="nuevacategoria" method="POST">
                <label>Nombre</label>
                <input class="form-control" type="text" name="nombre">
                <br>
                <button type="submit" class="btn btn-primary"> Agregar </button>
            </form>
        </div>
        {/if}
    </div>
{include 'templates/footer.tpl'} 