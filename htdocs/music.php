<?php require_once 'inc/bootstrap.php'; ?>
<?php include 'inc/header.php'; ?>
        <h2>Musik vom Weltraumschaf</h2>

        <div id="music">
            <p>Experimente mit <a href="http://www.ableton.com/" target="_blank">Ableton Live 8</a>,
            <a href="http://www.korg.com/kaossilator" target="_blank">Korg Kaossilator</a>,
            <a href="http://en.wikipedia.org/wiki/Korg_Polysix" target="_blank">Korg Polysix</a> und
            <a href="http://www.use-audio.com/plugiator.htm" target="_blank">Plugiator</a>:
                <ul>
                    <li>Drums: <a href="files/Drums.mp3" target="_blank">mp3</a></li>
                    <li>Leipzig: <a href="files/Leipzig.mp3" target="_blank">mp3</a></li>
                    <li>Namaste: <a href="files/Namaste.mp3" target="_blank">mp3</a></li>
                    <li>Unbenannt: <a href="files/Unbenannt.mp3" target="_blank">mp3</a> &ndash;
                        <a href="files/Unbenannt.ogg" target="_blank">ogg</a></li>
                </ul>
            </p>
        </div>

<?php if ( ! isAjax()): ?>
        <?php include 'inc/backlink.html'; ?>
        <?php include 'inc/footer.php'; ?>
<?php endif; ?>