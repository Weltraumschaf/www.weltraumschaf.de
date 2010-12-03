<?php
require_once 'inc/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <?php echo girly(WS_DATA_DIRECTORY . '/girly'); ?>
        <title>Photos die das Weltraumschaf geschossen hat</title>
        <meta name="description" content="Impressum" />
        <meta name="keywords" content="Sven, Strittmatter, Weltraumschaf, privat, Bilder" />
        <?php include 'inc/head_include.html'; ?>
        <?php include 'inc/head_javascript.html'; ?>
    </head>

    <body>
        <h1>Ein Bild vom Weltraumschaf</h1>

        <div id="photo"></div>

        <ul id="links">
            <li>
                <a href="./index.php">zur&uuml;ck</a>
            </li>
        </ul>

        <?php include 'inc/body_javascript.html'; ?>

    </body>
</html>