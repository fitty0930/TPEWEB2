{include file="header.tpl"}
    <div class="container">
        {if $nombreUsuario}
        <h3> Lo sentimos {$nombreUsuario}</h3>
        {else}
        <h3> Lo sentimos </h3>
        {/if}
        <p> Tuvimos un problema para completar su solicitud</p>
        <h3>{$MsjError}</h3>
    </div>
{include file="footer.tpl"}