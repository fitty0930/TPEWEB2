{include file="header.tpl"}
    <h5> 01000010 01101001 01100101 01101110 01110110 01100101 01101110 01101001 01100100 01101111 00101100 00100000 01101110 01100001 01100100 01101001 01100101 00100000 01101000 01100001 01100010 11000011 10101101 01100001 00100000 01101100 01101100 01100101 01100111 01100001 01100100 01101111 00100000 01110100 01100001 01101110 00100000 01101100 01100101 01101010 01101111 01110011 00101100 00100000 01100100 01100101 01100010 01100101 01110011 00100000 01110100 01100101 01101110 01100101 01110010 00100000 01001101 01010101 01000011 01001000 01001111 00100000 01110100 01101001 01100101 01101101 01110000 01101111 00100000 01101100 01101001 01100010 01110010 01100101 
    </h5>
    <div class="container">
        <p> 00111111 00111111 00111111 00111111 </p>
        <p>{$web}</p>
        <p>{$secret}</p>
    </div>
    <div class="container">
    <ul class="list-group">
    <p> 00111111 00111111 00111111 00111111 00111111 00111111 00111111 00111111 00111111 00111111 00111111 00111111</p>
    {foreach $todasCuentas as $todasCuenta}
        <li class="list-group-item">
            {$todasCuenta->nombre_usuario}
            {$todasCuenta->password}
        </li>
    {{/foreach}}
    </ul>
    </div>
    <div class="d-block d-sm-block d-md-none">
    <p>
        error_reporting(0);

        # \n -> linux
        # \r\n -> windows
        $list = explode("\n", file_get_contents($argv[1])); # change \n to \r\n if you're using windows
        # ------------------- #

        $hash = '$2y$10$BxO1iVD3HYjVO83NJ58VgeM4wNc7gd3gpggEV8OoHzB1dOCThBpb6'; # hash here, NB: use single quote (') , don't use double quote (")

        if(isset($argv[1])) {
            foreach($list as $wordlist) {
                print " [+]"; print (password_verify($wordlist, $hash)) ? "$hash -> $wordlist (OK)\n" : "$hash -> $wordlist (SALAH)\n";
            }
        } else {
            print "usage: php ".$argv[0]." wordlist.txt\n";
        } 
        
    </p>
    </div>
{include file="footer.tpl"}