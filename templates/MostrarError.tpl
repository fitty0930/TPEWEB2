{include file="header.tpl"}
    <div class="container">
        {if $UsuarioAdm}
        <h3> Lo sentimos {$UsuarioAdm}</h3>
        {else}
        <h3> Lo sentimos </h3>
        {/if}
        <p> Tuvimos un problema para completar su solicitud</p>
        <h3>{$MsjError}</h3>
    </div>
{include file="footer.tpl"}