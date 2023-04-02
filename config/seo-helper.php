<?php

return [
    /* -----------------------------------------------------------------
     |  Title
     | -----------------------------------------------------------------
     */
    'title' => [
        'default'   => 'Ekipişi Yazılım ve Danışmanlık Hizmetleri',
        'site-name' => 'Ekipişi Yazılım ve Danışmanlık Hizmetleri',
        'separator' => '-',
        'first'     => true,
        'max'       => 55,
    ],

    /* -----------------------------------------------------------------
     |  Description
     | -----------------------------------------------------------------
     */
    'description' => [
        'default'   => 'Ekipişi E-Ticaret Sitesi Yazılımları ile Sanal Mağazanızı hemen açın. İşinizi internete taşıyın.',
        'max'       => 255,
    ],

    /* -----------------------------------------------------------------
     |  Keywords
     | -----------------------------------------------------------------
     */
    'keywords'  => [
        'default'   => [
            'ekipişi', 
            'e-ticaret', 
            'e-ticaret yazılım',
            'e-ticaret danışmanlığı',
            'e-ticaret izmir',
            'e-ticaret sitesi',
            'e-ticaret sitesi kurmak',
            'e-ticaret sitesi fiyatları',
            'e-ticaret paketi',
            'hazır e-ticaret sitesi',
            'izmir e-ticaret', 
            'demo e-ticaret', 
            'internetten satış',
            'hazır eticaret sitesi',
            'sosyal medya', 
            'google adwords', 
            'facebook ads', 
            'kurumsal web sayfası',
            'google a kayıt'
        ],
    ],

    /* -----------------------------------------------------------------
     |  Miscellaneous
     | -----------------------------------------------------------------
     */
    'misc'      => [
        'canonical' => true,
        'robots'    => config('app.env') !== 'production', // Tell robots not to index the content if it's not on production
        'default'   => [
            'viewport'  => '', // Responsive design thing
            'author'    => 'https://plus.google.com/+ekipisi',
            'publisher' => 'https://plus.google.com/+ekipisi',
        ],
    ],

    /* -----------------------------------------------------------------
     |  Webmaster Tools
     | -----------------------------------------------------------------
     */
    'webmasters' => [
        'google'    => '',
        'bing'      => '',
        'alexa'     => '',
        'pinterest' => '',
        'yandex'    => '',
    ],

    /* -----------------------------------------------------------------
     |  Open Graph
     | -----------------------------------------------------------------
     */
    'open-graph' => [
        'enabled'     => true,
        'prefix'      => 'og:',
        'type'        => 'website',
        'title'       => 'Ekipişi Yazılım ve Danışmanlık Hizmetleri',
        'description' => 'Ekipişi E-Ticaret Sitesi Yazılımları ile Sanal Mağazanızı hemen açın. İşinizi internete taşıyın.',
        'site-name'   => '',
        'properties'  => [
            //
        ],
    ],

    /* -----------------------------------------------------------------
     |  Twitter
     | -----------------------------------------------------------------
     |  Supported card types : 'app', 'gallery', 'photo', 'player', 'product', 'summary', 'summary_large_image'.
     */
    'twitter' => [
        'enabled' => true,
        'prefix'  => 'twitter:',
        'card'    => 'summary',
        'site'    => 'ekipisiyazilim',
        'title'   => 'Ekipişi Yazılım ve Danışmanlık Hizmetleri',
        'metas'   => [
            //
        ],
    ],

    /* -----------------------------------------------------------------
     |  Analytics
     | -----------------------------------------------------------------
     */
    'analytics' => [
        'google' => '', // UA-60441501-32
    ],
];
