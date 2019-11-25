{include 'templates/header.tpl'}
<ul>
    {foreach $usuarios as $usuario} 
            {if $nombreUsuario!= $usuario->nombre_usuario } 
            {* para no mostrarme a mi mismo logueado seria estupido quitarme permisos a mi
            mismo  *}
            <li>
            Nombre: {$usuario->nombre_usuario}
            Condicion: {if $usuario->admin== $administraAlgo}
                        <span class="badge badge-success text-wrap" style="width: 6rem;"> Usuario </span>
                        {else}
                        <span class="badge badge-danger text-wrap" style="width: 6rem;"> Administrador </span>
                    {/if}
            {* cambiar por button *}
            <small><a href="borrarcuenta/{$usuario->id_usuario}"> Eliminar </a></small>
            <small><a href="darpermisocuenta/{$usuario->id_usuario}"> Alternar permisos </a></small>
            </li>
            {/if}
    {/foreach}
</ul>
{include 'templates/footer.tpl'}