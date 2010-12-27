<?php
require_once 'inc/bootstrap.php';
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
        <title>Photos die das Weltraumschaf geschossen hat</title>
        <meta name="description" content="Impressum" />
        <meta name="keywords" content="Sven, Strittmatter, Weltraumschaf, privat, Bilder" />
        <?php include 'inc/head_include.html'; ?>
        <?php include 'inc/head_javascript.html'; ?>
    </head>

    <body>
        <h1>Ein Bild vom Weltraumschaf</h1>
        <div id="photo"></div>
        <?php include 'inc/backlink.html'; ?>
        <?php include 'inc/body_javascript.html'; ?>
    </body>
</html>