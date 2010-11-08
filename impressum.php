<!DOCTYPE html>
<html lang="de">
    <head>
	<?php
	$girly = file_get_contents(__DIR__ . '/data/girly');

	if ($girly) {
	    echo "<!--\n$girly\n-->\n";
	}
	?>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Impressum von weltraumschaf.de</title>
        
        <meta name="description" content="Impressum" />
        <meta name="keywords" content="Sven, Strittmatter, privat, Impressum, Lizenz" />
        <meta http-equiv="content-language" content="de" />

        <meta name="robots" content="all" />

        <link href="css/main.css" rel="stylesheet" type="text/css" />

        <?php include 'inc/head_javascript.html'; ?>
    </head>
    
    <body>
        <h1>Impressum von weltraumschaf.de</h1>

        <div id="impressum">
            <p>Sollten Sie mich aus irgendwelchen Gr&uuml;nden kontaktiern wollen,
               dann k&ouml;nnen Sie das per E-Mail tun. Klicken Sie
               <a class="contact" title="hier">ich(at)weltraumschaf(dot)de</a>.</p>

            <p>Wollen Sie mehr Informationen &uuml;ber dies Domain, dann k&ouml;nnen
               Sie diese bei der <a href="http://www.denic.de/">DeNIC</a> abrufen.</p>

            <p>Alles auf dieser Website wird unter der <a href="./the-beer-ware-license.txt">
               Beer-Ware license</a> ver&ouml;ffentlicht.</p>
       </div>

        <ul id="links">
            <li>
                <a href="./index.php">zur&uuml;ck</a>
            </li>
        </ul>

        <?php include 'inc/body_javascript.html'; ?>
        
    </body>
</html>
