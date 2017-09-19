<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii test application</h1>
    <br>
</p>

This application use yii2 advanced template [Yii 2](http://www.yiiframework.com/) 
<p> Next texnologis were used</p>
<ul>
<li> Yii2 advanced template</li>
<li> RabbitMQ</li>
<li> ElasticSearch</li>
</ul>
To run this application yiu can use vagrant 
<ol>
<li>
<p>Install <a href="https://www.virtualbox.org/wiki/Downloads">VirtualBox</a></p>
</li>
<li>
<p>Install <a href="https://www.vagrantup.com/downloads.html">Vagrant</a></p>
</li>
<li>
<p>Create GitHub <a href="https://github.com/blog/1509-personal-api-tokens">personal API token</a></p>
</li>
<p>Place your GitHub personal API token to <code>vagrant-local.yml</code></p>
</li>
<li>
<p>Change directory to project root</p>
</li>
<li>
<p>Run commands:</p>
<div class="highlight highlight-source-shell"><pre>vagrant plugin install vagrant-hostmanager
vagrant up</pre></div>
</li>
</ol>
<p>That's all. You just need to wait for completion! After that you can access project locally by URLs:</p>
<ul>
<li>frontend: <a href="http://y2aa-frontend.dev">http://y2aa-frontend.dev</a></li>
<li>backend: <a href="http://y2aa-backend.dev">http://y2aa-backend.dev</a></li>
<li>api: <a href="http://y2aa-backend.dev">http://y2aa-frontend.dev/api/customers</a></li>
</ul>
<b>Note! For api we use HttpBearerAuth authentication method based on HTTP Bearer token.</b> 
<p>So before test api you must get access_token. You can get it in admin panel. Next credentials are available:
<ul>
<li>
login = 'admin';
</li>
<li>
email = 'admin@admin.com';
</li>
<li>
password = 'admin';
</li>
</ul>
</p>
