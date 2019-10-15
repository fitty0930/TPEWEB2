{include file="header.tpl"}
<div class="container">
    <form action="checklogin" method="POST" class="col-md-4 offset-md-4 mt-4">
        <h1>{$titulo}</h1>

        <div class="form-group">
            <label>Usuario</label>
            <input type="text" name="usuario" class="form-control" placeholder="Usuario">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>

        <div class="g-recaptcha" data-sitekey="{$webkey}"></div>
        {if $error}
        <div class="alert alert-danger" role="alert">
            {$error}
        </div>
        {/if} 

        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>

</div>
{include file="footer.tpl"}