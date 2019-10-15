{include 'templates/header.tpl'}  
    
    <h3> {$categoria->nombre} </h3>
    <div>
        <form action="editarcategoria/{$categoria->id_categoria}" method="POST">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{$categoria->nombre}">
            <button type="submit">Editar Categoria</button>
        </form>
    </div>
{include 'templates/footer.tpl'} 