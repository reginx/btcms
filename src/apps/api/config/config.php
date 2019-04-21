<?php
// http://dev.rgx.re/wiki/config.html
// @see rgx/class/config.class.php
return [
    'db' => [
        'pre'       => 'pre_',
        'type'      => 'mysql',
        'mysql'     => [
            'default' => 'host=127.0.0.1;port=3306;db=btcms;user=root;passwd=;charset=utf8;profiling=1',
        ],
    ],

    // 会话配置
    'sess'     => [
        'type'      => 'php',
        // 默认通过 cookie 传递 ( 可选 cookie, header)
        'via'       => 'cookie',
        // 默认实现
        'php'       => [
            'ttl'   => 1800,
        ]
    ]
];
