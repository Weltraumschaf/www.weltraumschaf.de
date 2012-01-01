<?php require_once 'inc/bootstrap.php'; ?>
<?php if ( ! isAjax()): ?>
<?php include 'inc/header.php'; ?>
<?php endif; ?>

        <h2>Musik vom Weltraumschaf</h2>

        <div id="music">
            <p>
                Experimente mit <a href="http://www.ableton.com/" target="_blank">Ableton Live 8</a>,
                <a href="http://www.korg.com/kaossilator" target="_blank">Korg Kaossilator</a>,
                <a href="http://en.wikipedia.org/wiki/Korg_Polysix" target="_blank">Korg Polysix</a> und
                <a href="http://www.use-audio.com/plugiator.htm" target="_blank">Plugiator</a>:
            </p>
            <table>
                <tr>
                    <td>Drums</td>
                    <td><a href="files/Drums.mp3" target="_blank">mp3</a></td>
                    <td><a href="files/Drums.ogg" target="_blank">ogg</a></td>
                    <td>
                        <audio controls="controls">
                            <source src="files/Drums.mp3" type="audio/mp3"/>
                            <source src="files/Drums.ogg" type="audio/ogg"/>
                            Your browser is too old. Go away and upgrade your Browser!
                        </audio>
                    </td>
                </tr>
                <tr>
                    <td>Leipzig</td>
                    <td><a href="files/Leipzig.mp3" target="_blank">mp3</a></td>
                    <td><a href="files/Leipzig.ogg" target="_blank">ogg</a></td>
                    <td>
                        <audio controls="controls">
                            <source src="files/Leipzig.mp3" type="audio/mp3"/>
                            <source src="files/Leipzig.ogg" type="audio/ogg"/>
                            Your browser is too old. Go away and upgrade your Browser!
                        </audio>
                    </td>
                </tr>
                <tr>
                    <td>Namaste</td>
                    <td><a href="files/Namaste.mp3" target="_blank">mp3</a></td>
                    <td><a href="files/Namaste.ogg" target="_blank">ogg</a></td>
                    <td>
                        <audio controls="controls">
                            <source src="files/Namaste.mp3" type="audio/mp3"/>
                            <source src="files/Namaste.ogg" type="audio/ogg"/>
                            Your browser is too old. Go away and upgrade your Browser!
                        </audio>
                    </td>
                </tr>
                <tr>
                    <td>Unbenannt</td>
                    <td><a href="files/Unbenannt.mp3" target="_blank">mp3</a></td>
                    <td><a href="files/Unbenannt.ogg" target="_blank">ogg</a></td>
                    <td>
                        <audio controls="controls">
                            <source src="files/Unbenannt.mp3" type="audio/mp3"/>
                            <source src="files/Unbenannt.ogg" type="audio/ogg"/>
                            Your browser is too old. Go away and upgrade your Browser!
                        </audio>
                    </td>
                </tr>
            </table>
        </div>

<?php if ( ! isAjax()): ?>
        <?php include 'inc/backlink.html'; ?>
        <?php include 'inc/footer.php'; ?>
<?php endif; ?>