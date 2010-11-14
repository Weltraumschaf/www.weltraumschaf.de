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
        <title>Hier wohnt das Weltraumschaf</title>

        <meta name="description" content="Private Website von Sven Strittmatter" />
        <meta name="keywords" content="Sven, Strittmatter, Weltraumschaf, privat, Profile, Xing, GitHub, Linked in, KWICK!, PEAR, Hudson CI" />
        <meta http-equiv="content-language" content="de" />

        <meta name="robots" content="all" />

        <link href="css/main.css" rel="stylesheet" type="text/css" />

        <?php include 'inc/head_javascript.html'; ?>
    </head>
    <body>
        <h1>Hier wohnt das Weltraumschaf</h1>

        <ul id="profiles">
            <li>
                <a href="http://blog.weltraumschaf.de/" title="Mein Blog">
                    <img src="img/Rss.png" alt="Blog" />
                </a>
            </li>
            <li>
                <a href="http://twitter.com/Weltraumschaf/" title="Mein Twitter">
                    <img src="img/Twitter.png" alt="Twitter" />
                </a>
            </li>
            <li>
                <a href="http://www.xing.com/profile/Sven_Strittmatter" title="Mein Xing-Profil">
                    <img src="img/Xing.png" alt="Xing" />
                </a>
            </li>
            <li>
                <a href="http://de.linkedin.com/pub/sven-strittmatter/21/751/537" title="Mein Linked in-Profil">
                    <img src="img/Linkedin.png" alt="Linked in" />
                </a>
            </li>
            <li>
                <a href="http://www.kwick.de/Weltraumschaf" title="Mein KWICK!-Profil">
                    <img src="img/Kwick.png" alt="KWICK!" />
                </a>
            </li>
            <li>
                <a href="http://github.com/Weltraumschaf/" title="Meine GitHub Repositories">
                    <img src="img/Github.png" alt="GitHub" />
                </a>
            </li>
            <li>
                <a href="http://www.weltraumschaf.de:8080/" title="Mein Hudson CI Server">
                    <img src="img/Hudson.png" alt="Hudson CI" />
                </a>
            </li>
            <li>
                <a href="http://pear.weltraumschaf.de/" title="Mein PEAR Channel">
                    <img src="img/Pear.png" alt="PEAR" />
                </a>
            </li>
        </ul>

        <ul id="links">
            <li>
                <a href="http://kapit.weltraumschaf.de" title="KWICK! API Testtool">
                    KAPIT</a> &mdash;
                <a href="./impressum.php" title="Lizenz und so&hellip;">Impressum</a> &mdash;
                <a class="contact" title="E-Mail an mich">
                    ich(at)weltraumschaf(dot)de</a> &mdash;
                <a href="http://www.cacert.org/index.php?id=3" title="Braucht man f&uuml;r https://www.weltraumschaf.de">
                    Root-Zertifikate von CAcert</a>
            </li>
        </ul>

        <?php include 'inc/body_javascript.html'; ?>
        
    </body>
</html>
