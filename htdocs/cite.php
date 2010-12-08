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
            <?php include 'inc/backlink.html'; ?>
        </ul>

        <?php include 'inc/body_javascript.html'; ?>

    </body>
</html>