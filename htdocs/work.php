<?php require_once 'inc/bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="de">
    <head>
	<?php echo girly(WS_DATA_DIRECTORY . '/girly'); ?>
        <title>Dinegn an denen das Weltraumschaf arbeitet</title>
        <meta name="description" content="Impressum" />
        <meta name="keywords" content="Sven, Strittmatter, Weltraumschaf, privat, Arbeiten" />
        <?php include 'inc/head_include.html'; ?>
        <?php include 'inc/head_javascript.html'; ?>
    </head>

    <body>
        <h1>Arbeiten vom Weltraumschaf</h1>

        <div id="work">
            <p>Dinge an denen ich arbeite oder die ich gemacht habe.</p>

            <p><a href="http://kapit.weltraumschaf.de/">KAPIT</a> ist das KWICK!
            API Test-Tool. Gebaut habe ich das kleine Frontend um mit der
            <a href="http://developer.kwick.com/">KWICK! Social Plattform API</a>
            herum spielen zu k&ouml;nnen. Man kann mit diesem Tool relativ einfach
            die API ausprobieren ohne etwas programmieren zu m&uuml;ssen.</p>
            
            <p><a href="http://www.lugagne.de/">Lugagne.de</a> ist die Website
            meines ehemaligen Nachbars.</p>
        </div>

        <ul id="links">
            <li>
                <a href="./index.php">zur&uuml;ck</a>
            </li>
        </ul>

        <?php include 'inc/body_javascript.html'; ?>

    </body>
</html>