<?php require_once 'inc/bootstrap.php'; ?>
<?php include 'inc/header.php'; ?>
    <h2>Arbeiten vom Weltraumschaf</h2>

    <div id="work">
        <p>Dinge an denen ich arbeite oder die ich gemacht habe.</p>

        <p>Ein <a href="https://github.com/Weltraumschaf/hudson-darcs" target="_blank" title="Fork me on GitHub!">
        Plugin</a> zur Integration des <a href="http://en.wikipedia.org/wiki/Distributed_Version_Control_System" target="_blank" title="Wikipedia">
        DVCS</a> <a href="http://darcs.net/" target="_blank">Darcs</a> in den <a href="http://jenkins-ci.org/" target="_blank">
        Jenkins</a> continious integration servers.</p>

        <p><a href="http://kapit.weltraumschaf.de/" target="_blank">KAPIT</a> ist das KWICK!
        API Test-Tool. Gebaut habe ich das kleine Frontend um mit der
        <a href="http://developer.kwick.com/" target="_blank">KWICK! Social Plattform API</a>
        herum spielen zu k&ouml;nnen. Man kann mit diesem Tool relativ einfach
        die API ausprobieren ohne etwas programmieren zu m&uuml;ssen.</p>

        <p><a href="http://www.lugagne.de/" target="_blank">Lugagne.de</a> ist die Website
        meines ehemaligen Nachbars.</p>

        <p>Diversen Kram den ich mal gebastelt habe gibt's <a href="http://sxs.weltraumschaf.de/">hier</a>.</p>
    </div>

<?php if ( ! isAjax()): ?>
        <?php include 'inc/backlink.html'; ?>
        <?php include 'inc/footer.php'; ?>
<?php endif; ?>