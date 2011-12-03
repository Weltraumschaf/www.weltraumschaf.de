<?php require_once 'inc/bootstrap.php'; ?>
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
        <title>Hier wohnt das Weltraumschaf</title>
        <meta name="description" content="Private Website von Sven Strittmatter" />
        <meta name="keywords" content="Sven, Strittmatter, Weltraumschaf, privat, Profile, Xing, GitHub, Linked in, KWICK!, PEAR, Hudson CI" />
        <?php include 'inc/head_include.php'; ?>
    </head>
    <body>
        <h1>Hier wohnt das Weltraumschaf</h1>
<!--        <div id="text-shadow-box">
            <div class="wall">
                <div id="tsb-box"></div>
                <p id="tsb-text">Weltraumschaf</p>
                <div></div>
            </div>

            <div id="tsb-spot"></div>
        </div>-->

        <div id="profiles">
            <ul>
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
        </div>

        <div id="links">
            <a href="work.html" rel="facebox" title="Arbeiten vom Weltraumschaf">
                Arbeiten</a> &ndash;
                <a href="cite.php" rel="facebox" title="Ein Zitat das Weltraumschaf gut findet">
                Zitat</a> &ndash;
            <a href="music.html" rel="facebox" title="Musik vom Weltraumschaf">Musik</a> &ndash;
            <a href="impressum.html" rel="facebox" title="Lizenz und so&hellip;">Impressum</a> &ndash;
            <a class="contact" title="E-Mail an mich">
                ich(at)weltraumschaf(dot)de</a> &ndash;
            <a href="http://www.cacert.org/index.php?id=3" title="Braucht man f&uuml;r https://www.weltraumschaf.de">
                Root-Zertifikate von CAcert</a>
        </div>

        <?php include 'inc/body_javascript.php'; ?>
    </body>
</html>
