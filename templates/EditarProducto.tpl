{include file="header.tpl"} {* template dentro de un template *}
    <div class="container">
      <h3> {$producto->producto} </h3>

        <form action="editarproducto/{$producto->id_producto}" method="POST">

                <label>Nombre del producto</label>
                <input type="text" name="producto" value="{$producto->producto}">

                <label>Marca </label>
                <input type="text" name="marca" value="{$producto->marca}">

                <label> Precio </label>
                <input type="number" name="precio" value="{$producto->precio}">

                <select class="custom-select" name="categoria" id="categoria"> {* se llama nombre dentro de categorias y id-cat dentro de productos*}
                <option selected value="{$producto->id_categoria}" > {$selector->id_categoria} </option>
                {* aca selecciono categorias *}
                {foreach $categorias as $categoria}
                {if $producto->id_categoria!=$categoria->id_categoria}
                {* para no hacer nada *}
                <option value="{$categoria->id_categoria}">{$categoria->nombre}</option>
                {/if}
                {/foreach}
                </select>
                <div>
                {* imagenes *}
                <label>Imagenes: </label>
                <br>
                <input type="file" name="imagenes[]" accept=".jpg, .png, .jpeg" multiple="">
                
                </div>
            <br>
            <button type="submit" class="btn btn-primary" name="editar" value="{$producto->id_producto}"> Editar </button>
            
        </form>
    </div>
 

{include file="footer.tpl"}  {* template dentro de un template *}