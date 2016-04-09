<!DOCTYPE html>
<html lang="${language}">
    <head>
        <meta name="robots" content="all"/>
        <meta name="description" content="${description}"/>
        <meta name="keywords" content="${keywords}"/>
        <meta charset="${encoding}"/>
        <link href="${baseUrl}/css/main.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="${baseUrl}/img/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
        <link href="${baseUrl}/feed.xml"  rel="alternate" type="application/rss+xml" title="Das Weltraumschaf | Feed" />
    </head>

    <body>
        <div id="page">
            <header id="branding">
                <hgroup>
                    <h1 id="site-title">${blogTitle}</h1>
                    <h2 id="site-description">${blogDescription}</h2>
                    <a id="rss" href="${baseUrl}/feed.xml" title="RSS">
                        <img src="${baseUrl}/img/rss.png" width="128" height="128"/>
                    </a>
                </hgroup>
                
                <img width="940" height="198" src="${baseUrl}/img/logo.jpg">
                
                <nav id="access">
                    <div>
                        <ul>
                            <li class="current_page_item">
                                <a title="Home" href="<%= siteUrl %>">Home</a>
                            </li>
                            <% for site in sites %>
                            <li>
                                <a title="<%= site.title %>" href="<%= site.url %>"><%= site.navi %></a>
                            </li>
                            <% end %>
                        </ul>
                    </div>
                </nav>
            </header>

            <div id="main">
                <div id="primary">
                    <div id="content" role="main">
                        ${content}
                    </div>
                </div>
            
                <div id="secondary">
                    <aside>
                        <h3 class="meta">me</h3>
                        <ul>
                            <li><a href="https://plus.google.com/111699688981457167133/posts" rel="me" title="My profile in Google Plus.">Me at G+</a></li>
                            <li><a href="http://github.com/Weltraumschaf" rel="me" title="My Github profile.">Me at Github</a></li>
                            <li><a href="http://www.kwick.de/Weltraumschaf" rel="me" title="Here is where I work.">Me at KWICK!</a></li>
                            <li><a href="http://www.xing.com/profile/Sven_Strittmatter" rel="me" title="My Xing profile.">Me at Xing</a></li>
                            <li><a href="http://www.linkedin.com/pub/sven-strittmatter/21/751/537" rel="me" title="My LinkedIn profile">Me at LinkedIn</a></li>
                        </ul>
                    </aside>
                    <aside>
                        <h3 class="meta">others</h3>
                        <ul>
                            <li><a href="http://chaosradio.ccc.de/chaosradio_express.html" title="The Chaos Radio Express podcast (german).">Chaosradio Express</a></li>
                            <li><a href="http://dypsilon.com/notes" rel="friend met colleague" title="Business Value driven Web Developer.">Double Ypsilon</a></li>
                            <li><a href="http://www.garanbo.de/" title="Easy organize your warranty papers.">Garanbo</a></li>
                            <li><a href="http://www.heise.de/developer/podcast/" title="The Heise Developer Podcast (german).">Heise Developer Podcast</a></li>
                            <li><a href="http://twitter.com/_stritti_" rel="met sibling" title="My big brothers Twitter.">Mo Brother</a></li>
                        </ul>
                    </aside>
                    <aside>
                        <h3 class="meta">projects</h3>
                        <ul>
                            <li><a href="https://github.com/Weltraumschaf/uberblog">Uberblog</a></li>
                            <li><a href="http://weltraumschaf.github.com/jebnf/">JEBNF</a></li>
                            <li><a href="http://weltraumschaf.github.com/umleto/">UMLeto</a></li>
                            <li><a href="https://github.com/Weltraumschaf/darcs-plugin">Jenkins Darcs Plugin</a></li>
                        </ul>
                    </aside>
                    <aside>
                        <h3 class="meta">version ${blogVersion}</h3>
                    </aside>
                </div>

                <footer role="contentinfo">
                    Proudly made without PHP and MySQL, but with some <a title="Source code at GitHub." href="https://github.com/Weltraumschaf/JUberblog">Java</a>.
                </footer>
            </div>
        </div>
        
        <script type="text/javascript" src="${baseUrl}/js/main.js"></script>
    </body>
</html>