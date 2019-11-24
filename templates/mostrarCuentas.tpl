{include 'templates/header.tpl'}
<ul>
    {foreach $usuarios as $usuario} 
            {if $nombreUsuario!= $usuario->nombre_usuario } 
            {* para no mostrarme a mi mismo logueado seria estupido quitarme permisos a mi
            mismo  *}
            <li>
            Nombre: {$usuario->nombre_usuario}
            Es admin?: {if $usuario->admin==0}
                        No
                        {else}
                        Si
                    {/if}
            {* cambiar por button *}
            <small><a href="borrarcuenta/{$usuario->id_usuario}"> Eliminar </a></small>
            <small><a href="darpermisocuenta/{$usuario->id_usuario}"> Alternar permisos </a></small>
            </li>
            {/if}
    {/foreach}
</ul>
{include 'templates/footer.tpl'}