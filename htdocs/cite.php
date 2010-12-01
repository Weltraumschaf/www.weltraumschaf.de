<?php
/**
 * The root directory of the repo.
 */
define('WS_ROOT_DIRECTORY', dirname(__DIR__));
define('WS_DATA_DIRECTORY', WS_ROOT_DIRECTORY . '/data');

set_include_path(implode(PATH_SEPARATOR, array(
    WS_ROOT_DIRECTORY . '/lib',
    get_include_path()
)));

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
	<?php include 'inc/girly.php'; ?>
        <title>Dinegn an denen das Weltraumschaf arbeitet</title>
        <meta name="description" content="Impressum" />
        <meta name="keywords" content="Sven, Strittmatter, Weltraumschaf, privat, arbeiten" />
        <?php include 'inc/head_include.html'; ?>
        <?php include 'inc/head_javascript.html'; ?>
    </head>

    <body>
        <h1>Zitat</h1>

        <div id="cite">
            <p><?php echo $cite->getText(); ?></p>
            <p><em>
            <?php echo $cite->getAuthor(); ?>
            <?php if ($this->hastitle()): ?>
                (<?php echo $cite->getTitle(); ?>)
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