<?php

namespace App\Admin\Extensions\Nav;


class LinksLeft
{
    public function __toString()
    {
        $file_manager_link = admin_url('media');
        $config_link = admin_url('config');
        $api_tester_link = admin_url('api-tester');

        $scaffold_link = admin_url('helpers/scaffold');
        $database_link = admin_url('helpers/terminal/database');
        $artisan_link = admin_url('helpers/terminal/artisan');
        $routes_link = admin_url('helpers/routes');
        $exceptions_link = admin_url('exceptions');
        

        return <<<HTML
<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
<ul class="nav navbar-nav">
    <li>
        <a href="$file_manager_link">
            <i class="fa fa-fw fa-picture-o"></i> Dosya Yöneticisi
        </a>
    </li>
    <li>
        <a href="$config_link">
            <i class="fa fa-fw fa-toggle-on"></i> Ayarlar
        </a>
    </li>
    <li class="visible-lg">
        <a href="$api_tester_link">
            <i class="fa fa-fw fa-sliders"></i> Api Tester
        </a>
    </li>
    <li class="visible-lg">
        <a href="$exceptions_link">
            <i class="fa fa-fw fa-bug"></i> Hatalar</span>
        </a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-fw fa-gears"></i> Yardımcı Araçlar <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="$scaffold_link"><i class="fa fa-fw fa-keyboard-o"></i> Scaffold</a></li>
            <li><a href="$database_link"><i class="fa fa-fw fa-database"></i> Database Terminal</a></li>
            <li><a href="$artisan_link"><i class="fa fa-fw fa-terminal"></i> Artisan Terminal</a></li>
            <li><a href="$routes_link"><i class="fa fa-fw fa-list-alt"></i> Routes</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-fw fa-external-link"></i> Bağlantılar <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="https://analytics.google.com/analytics/web/" target="_blank">Google Analytics</a></li>
            <li><a href="https://search.google.com/search-console/index" target="_blank">Google Webmaster Tools</a></li>
            <li><a href="https://www.google.com/webmasters/tools/disavow-links-main?pli=1" target="_blank">Google Disavow Links</a></li>
            <li><a href="https://metrica.yandex.com/list" target="_blank">Yandex Metrica</a></li>
            <li><a href="https://intodns.com/" target="_blank">Into Dns</a></li>
            <li><a href="https://prnt.sc/" target="_blank">Print Screen</a></li>
            <li><a href="https://gtmetrix.com/" target="_blank">Gt Metrix</a></li>
            <li><a href="https://webpagetest.org/" target="_blank">Web Page Test</a></li>
            <li><a href="https://semrush.com/" target="_blank">Sem Rush</a></li>
        </ul>
    </li>
</ul>
</div>
HTML;
        
    }
}