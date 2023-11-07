<?php

// カスタム設定ファイル
return [
    // ページ設定ファイル
    'page' => [
        'index' => [
            'url' => '/',
            'route' => 'index',
            'name' => 'TOP'
        ],

        'category1' => [
            'url' => '/about',
            'route' => 'about',
            'name' => 'ABOUT'
        ],

        'category2' => [
            'url' => '/service',
            'route' => 'service',
            'name' => 'SERVICE'
        ],

        // 管理画面投稿一覧を表示するページで使用してください。
        'category3' => [
            'url' => '/works',
            'route' => 'works',
            'name' => 'WORKS'
        ],

        'category3_detail' => [
            'url' => '/works/detail',
            'route' => 'works.detail',
            'name' => 'WORKS詳細'
        ],
        // -------------------------------------------------------

        'category4' => [
            'url' => '/corporate',
            'route' => 'corporate',
            'name' => 'CORPORATE'
        ],

        'category5' => [
            'url' => '/recruit',
            'route' => 'recruit',
            'name' => 'RECRUIT'
        ],

        // 管理画面お知らせ一覧を表示するページで使用してください。
        'category6' => [
            'url' => '/news',
            'route' => 'news',
            'name' => 'NEWS'
        ],
        // -------------------------------------------------------

        'category6_detail' => [
            'url' => '/news/detail',
            'route' => 'news.detail',
            'name' => 'NEWS詳細'
        ],

        'category7' => [
            'url' => '/menu',
            'route' => 'menu',
            'name' => 'MENU'
        ],

        'category8' => [
            'url' => '/faq',
            'route' => 'faq',
            'name' => 'FAQ'
        ],

        // 以下はお問合せフォームで固定の為、変更不可です
        'contact' => [
            'url' => '/contact',
            'route' => 'contact',
            'name' => 'CONTACT'
        ],

        'contact_confirm' => [
            'url' => '/contact/confirm',
            'route' => 'contact.confirm',
            'name' => 'CONTACT CONFIRM'
        ],

        'contact_send' => [
            'url' => '/contact/send',
            'route' => 'contact.send',
            'name' => 'CONTACT SEND'
        ],
        'category9' => [
            'url' => '/productions',
            'route' => 'productions',
            'name' => 'PRODUCTIONS'
        ],
        'category10' => [
            'url' => '/voices',
            'route' => 'voices',
            'name' => 'VOICES'
        ],
        'category11' => [
            'url' => '/templates',
            'route' => 'templates',
            'name' => 'TEMPLATES'
        ],
        'category12' => [
            'url' => '/samples',
            'route' => 'samples',
            'name' => 'SAMPLES'
        ],
        // ----------------------------------------------------------------

    ],

    // ページ情報共通化の設定
    // 'コピー先のroute' => 'コピー元route'とすることで、ページ情報を共通化できます
    'page_info' => [
        'contact.confirm' => 'contact',
        'contact.send' => 'contact',
    ],

    // 表示アイコン設定
    'icon' => [
        'notice' => [
            '1' => 'お知らせ',
            '2' => '重要事項',
            '3' => 'ご案内',
        ],

        'news' => [
            ''=> 'アイコンを選択してください',
            1 => '重要',
            2 => '新着情報',
            3 => '更新情報',
            4 => 'イベント',
            5 => 'キャンペーン',
            6 => 'お知らせ',
        ],

        'requirement' => [
            1 => 'サービス内容',
            2 => '予約について',
            3 => '求人について',
            4 => 'その他',
        ],
    ],

    // ページネーション件数
    'paginate' => [
        'admin' => 20,  // 管理画面一覧
        'post' => '4',  // 投稿一覧
        'news' => '1',  // お知らせ一覧
        'sample' => '5',  // お知らせ一覧
        'template' => '5',  // お知らせ一覧
    ],

    // 表示数
    'limit' => [
        'notice' => 3,  // 管理画面トップ 運営部からのお知らせ
        'post' => 4,    // トップ 最新の投稿
        'post_latest' => '4',   // 投稿詳細 最新の投稿
        'news' => 5,    // トップ お知らせ
        'production' => 5,    // トップ お知らせ
        'voice' => 5,    // トップ お知らせ
    ],

    // 運営部からのお知らせのNEWを出す日数
    'new_life_days' => 14,

    // お問合せログに表示させる月数
    'log_life_month' => 3,

    // 表示・非表示フラグ
    'display' => [
        'off' => '0',
        'on'  => '1',
    ],

    // 画像保存先ディレクトリ名
    'directory' => [
        'post' => 'posts',
        'category' => 'categories',
        'sample' => 'samples',
        'template' => 'templates',
    ],

];
