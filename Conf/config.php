<?php
return array (
        //'ROOT' => 'http://127.0.0.1/me', // 网站根目录  放在这在Action中引用不到
        'URL_CASE_INSENSITIVE' => true, // 默认false 表示URL区分大小写 true则表示不区分大小写
        'DEFAULT_MODULE' => 'Home', // 默认模块名称
        'URL_HTML_SUFFIX' => '.html',
        'DB_FIELDS_CACHE' => false, // debug 关闭表字段缓存
        'DB_TYPE' => 'mysql',
        'DB_HOST' => 'localhost',
        'DB_NAME' => 'me',
        'DB_USER' => 'root',
        'DB_PWD' => "123456",
        'DB_PREFIX' => 'my_' 
);
?>