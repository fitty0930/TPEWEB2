{include file="header.tpl"}
    <div class="container">
        {if $nombreUsuario}
        <h3> Lo sentimos {$nombreUsuario}</h3>
        {else}
        <h3> Lo sentimos </h3>
        {/if}
        <h5> Tuvimos un problema para completar su solicitud</h5>
        <h5>{$MsjError}</h5>
        <a class="badge badge-primary text-wrap" style="width: 6rem;" href="./"> Volver al Inicio <a>
    </div>
{include file="footer.tpl"}