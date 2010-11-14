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
        <title>Dinegn an denen das Weltraumschaf arbeitet</title>

        <meta name="description" content="Impressum" />
        <meta name="keywords" content="Sven, Strittmatter, Weltraumschaf, privat, arbeiten" />
        <meta http-equiv="content-language" content="de" />

        <meta name="robots" content="all" />

        <link href="css/main.css" rel="stylesheet" type="text/css" />

        <?php include 'inc/head_javascript.html'; ?>
    </head>

    <body>
        <h1>Dinge an denen ich arbeite</h1>

        <div id="work">
            <p>KAPIT</p>
            <p>Lugagne.de</p>
        </div>

        <ul id="links">
            <li>
                <a href="./index.php">zur&uuml;ck</a>
            </li>
        </ul>

        <?php include 'inc/body_javascript.html'; ?>

    </body>
</html>