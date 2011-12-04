<?php

require_once 'inc/bootstrap.php';
require_once 'CiteProvider.php';
require_once 'CiteShuffler.php';

$dataProvider = new CiteProvider(WS_DATA_DIRECTORY . '/cites.xml');
$collection   = $dataProvider->getCollection();
$shuffler     = new CiteShuffler($collection);
$cite         = $shuffler->getCite();
?>
<?php if ( ! isAjax()): ?>
    <?php include 'inc/header.php'; ?>
<?php endif; ?>

        <h2>Ein Zitat das Weltraumschaf gut findet</h2>

        <div id="cite">
            <p><?php echo htmlify($cite->getText()); ?></p>
            <p>
                <em>
                    <?php echo htmlify($cite->getAuthor()); ?>
                    <?php if ($cite->hastitle()): ?>
                        (<?php echo htmlify($cite->getTitle()); ?>)
                    <?php endif; ?>
                </em>
            </p>
        </div>

<?php if ( ! isAjax()): ?>
        <?php include 'inc/backlink.html'; ?>
        <?php include 'inc/footer.php'; ?>
<?php endif; ?>