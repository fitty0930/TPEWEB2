{include 'templates/header.tpl'}
<ul class="list-group">
    {foreach $usuarios as $usuario} 
            {if $nombreUsuario!= $usuario->nombre_usuario } 
            {* para no mostrarme a mi mismo logueado seria estupido quitarme permisos a mi
            mismo  *}
            <li class="list-group-item">
            Nombre: {$usuario->nombre_usuario}
            Condicion: {if $usuario->admin== $administraAlgo}
                        <span class="badge badge-success text-wrap" style="width: 6rem;"> Usuario </span>
                        {else}
                        <span class="badge badge-danger text-wrap" style="width: 6rem;"> Administrador </span>
                    {/if}
            {* cambiar por button *}
            <small class="badge badge-light text-wrap" style="width: 6rem;"><a href="borrarcuenta/{$usuario->id_usuario}"> Eliminar </a></small>
            <small class="badge badge-light text-wrap" style="width: 6rem;"><a href="darpermisocuenta/{$usuario->id_usuario}"> Alternar permisos </a></small>
            </li>
            {/if}
    {/foreach}
</ul>
{include 'templates/footer.tpl'}