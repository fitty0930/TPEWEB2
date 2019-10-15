{include file="header.tpl"}   
    
    <div class="container">
    <h1>{$titulo}</h1>
        <ul class="list-group">
            {* imprimo con un foreach a cada cosa del objeto productos lo subdivido e imprimo *}
            {foreach $productos as $producto}
                <li class="list-group-item">{$producto->nombre}  ----  {$producto->producto} ---- {$producto->marca} --- Precio:${$producto->precio} 
                {if $UsuarioAdm}
                <a href="borrarproducto/{$producto->id_producto}"> Borrar </a>|<a href="edicionproducto/{$producto->id_producto}"> Modificar </a>
                {/if}
                </li>      
            {/foreach}
        </ul>
    </div>
    {if $UsuarioAdm}
    <div class="container">
        <div class="form-group">
            <br>
            <h2> Formulario de mantenimiento </h2>
            <form action="nuevoproducto" method="POST"> {* nuevo producto  *}
                    <div class="input-group-preprend">
                    <label>Nombre del producto</label>
                    <input class="form-control" type="text" name="producto" placeholder="Playstation"> {* se llama producto*}
                
                    <label> Marca del producto</label>
                    <input class="form-control" type="text" name="marca" placeholder="Sony"> {* se llama marca*}
                
                    <label> Precio del producto</label>
                    <input class="form-control" type="number" name="precio" placeholder="1000"> {* se llama precio*}
                    </div>
                    
                    <label> Categoria </label>
                    <div class="input-group">
                    <select class="custom-select" name="categoria" id="categoria"> {* se llama nombre dentro de categorias y id-cat dentro de productos*}
                        <option selected value="" > Elija una categoria </option>
                        {* aca selecciono categorias *}
                        {foreach $categorias as $categoria}
                            <option value="{$categoria->id_categoria}">{$categoria->nombre}</option>
                        {/foreach}
                    </select>
                    </div>
                <br>
                <button type="submit" class="btn btn-primary"> Agregar Producto </button>
            </form>
        </div>
    </div>
    {/if}
{include file="footer.tpl"} 
