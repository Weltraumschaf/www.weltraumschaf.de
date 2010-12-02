<?php require_once 'inc/bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="de">
    <head>
	<?php echo girly(); ?>
        <title>Hier wohnt das Weltraumschaf</title>
        <meta name="description" content="Private Website von Sven Strittmatter" />
        <meta name="keywords" content="Sven, Strittmatter, Weltraumschaf, privat, Profile, Xing, GitHub, Linked in, KWICK!, PEAR, Hudson CI" />
        <?php include 'inc/head_include.html'; ?>
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
                <a href="https://twitter.com/Weltraumschaf/" title="Mein Twitter">
                    <img src="img/Twitter.png" alt="Twitter" />
                </a>
            </li>
            <li>
                <a href="https://www.xing.com/profile/Sven_Strittmatter" title="Mein Xing-Profil">
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
                <a href="https://github.com/Weltraumschaf/" title="Meine GitHub Repositories">
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
                <a href="./work.php" title="Arbeiten vom Weltraumschaf">
                    Arbeiten</a> &mdash;
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
