<?php require_once 'inc/bootstrap.php'; ?>
<!DOCTYPE html>
<!--
   LICENSE

   "THE BEER-WARE LICENSE" (Revision 42):
   "Sven Strittmatter" <ich@weltraumschaf.de> wrote this file.
   As long as you retain this notice you can do whatever you want with
   this stuff. If we meet some day, and you think this stuff is worth it,
   you can buy me a beer in return.

   @author    Weltraumschaf
   @copyright Copyright (c) 01.12.2010, Sven Strittmatter.
   @version   0.2
   @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 -->
<html lang="de">
    <head>
	<?php echo girly(WS_DATA_DIRECTORY . '/girly'); ?>
        <title>Impressum von weltraumschaf.de</title>
        <meta name="description" content="Impressum" />
        <meta name="keywords" content="Sven, Strittmatter, Weltraumschaf, privat, Impressum, Lizenz" />
        <?php include 'inc/head_include.html'; ?>
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
            <?php include 'inc/backlink.html'; ?>
        </ul>

        <?php include 'inc/body_javascript.html'; ?>
        
    </body>
</html>