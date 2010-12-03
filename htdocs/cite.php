<?php
require_once 'inc/bootstrap.php';
require_once 'CiteProvider.php';
require_once 'CiteShuffler.php';

$dataProvider = new CiteProvider(WS_DATA_DIRECTORY . '/cites.xml');
$collection   = $dataProvider->getCollection();
$shuffler     = new CiteShuffler($collection);
$cite         = $shuffler->getCite();
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <?php echo girly(WS_DATA_DIRECTORY . '/girly'); ?>
        <title>Zitate die das Weltraumschaf gut findet</title>
        <meta name="description" content="Impressum" />
        <meta name="keywords" content="Sven, Strittmatter, Weltraumschaf, privat, Zitate" />
        <?php include 'inc/head_include.html'; ?>
        <?php include 'inc/head_javascript.html'; ?>
    </head>

    <body>
        <h1>Ein Zitat das Weltraumschaf gut findet</h1>

        <div id="cite">
            <p><?php echo htmlify($cite->getText()); ?></p>
            <p><em>
            <?php echo htmlify($cite->getAuthor()); ?>
            <?php if ($cite->hastitle()): ?>
                (<?php echo htmlify($cite->getTitle()); ?>)
            <?php endif; ?>
            </em></p>
        </div>

        <ul id="links">
            <li>
                <a href="./index.php">zur&uuml;ck</a>
            </li>
        </ul>

        <?php include 'inc/body_javascript.html'; ?>

    </body>
</html>