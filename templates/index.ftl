<h3>All Blog Posts</h3>
<ul>
    <#list posts as post>
    <li>
        <a href="${post.link}">${post.title}</a>
        <span class="date">(${post.pubDate?string["dd.MM.yyyy, HH:mm"]})</span>
    </li>
    </#list>
</ul>
