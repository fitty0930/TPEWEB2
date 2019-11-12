<!doctype html>
        <html lang="en">
          <head>
            <!-- Required meta tags -->
            <base href="{$basehref}">
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

            <title>{$titulo}</title>
            {* captcha *}
            {* <script src='https://www.google.com/recaptcha/api.js'></script> *}
            <script src="https://www.google.com/recaptcha/api.js?render=_reCAPTCHA_site_key"></script>
            {* <script src="https://www.google.com/recaptcha/api.js" async defer></script> *}
            
          </head>
          
          <body>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <a class="navbar-brand" href="home"> Tienda El Turulito </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="productos">Productos</a> {* te lleva a productos  *}
                  </li>
                  {if $adminAdm != 0}
                  <li class="nav-item active">
                    <a class="nav-item nav-link" href="categorias"> Administrar Categorias </a>
                  </li>
                  {/if}
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="categorias" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Categorias</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      {foreach $categorias as $categoria} {* usar minuscula *}
                        <a class="dropdown-item" href="categorias/{$categoria->id_categoria}">{$categoria->nombre}</a>
                      {* te lleva a la categoria en cuestion *}
                      {/foreach}
                    </div>
                  </li>
                </ul>

                {if $usuarioAdm} {* tiene problemas *}
                {* isset($smarty.session.id_usuario) ==  (isset($_SESSION['id_usuario'])) *}
                    <div class="navbar-nav ml-auto">
                        <span class="navbar-text">{$usuarioAdm}</span>
                        <a class="nav-item nav-link" href="logout"> Salir </a>
                    </div> 
                    {else}
                    <div class="navbar-nav ml-auto">
                        <a class="nav-item nav-link" href="login"> Ingresar </a>
                    </div> 
                    <div class="navbar-nav ">
                        <a class="nav-item nav-link" href="registry"> ¿No tenes cuenta? registrate ahora</a>
                    </div>
                  {/if}
              </div>
            </nav>