<?php

require_once 'CiteProvider.php';
require_once 'CiteShuffler.php';

/**
 * Description of Html
 *
 * @author Sven Strittmatter <weltraumschaf@googlemail.com>
 * @license http://www.weltraumschaf.de/the-beer-ware-license.txt THE BEER-WARE LICENSE
 */
class Html {
    
    public function getCiteHtml() {
        $dataProvider = new CiteProvider(WS_DATA_DIRECTORY . '/cites.xml');
        $collection   = $dataProvider->getCollection();
        $shuffler     = new CiteShuffler($collection);
        $cite         = $shuffler->getCite();
        $sb           = new Monkey\StringBuilder('<h2>Ein Zitat das Weltraumschaf gut findet</h2>');
        $sb->append('<div id="cite">');
        $sb->append('<p>');
        $sb->append(htmlify($cite->getText()));
        $sb->append('</p>');
        $sb->append('<p>');
        $sb->append('<em>');
        $sb->append(htmlify($cite->getAuthor()));
            
        if ($cite->hastitle()) {
            $sb->append(' (');
            $sb->append(htmlify($cite->getTitle()));
            $sb->append(')');
        }
                
        $sb->append('</em>');    
        $sb->append('</p>');
        $sb->append('</div>');
    
        return $sb;
    }
}
