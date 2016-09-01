<?php
return array(
    // ----------------------------  CONFIG ENV  -----------------------------//
    'env' => array(
        'language' => 'zh_cn',
    ),
    // ----------------------------  CONFIG DB  ----------------------------- //
    'databases'=>array(

        'db' => array(
            'host' => '192.168.13.27',
            'port' => '3316',
            'dbname' => 'dmcark_cps',
            'username' => 'mysql.da-mai.com',
            'password' => 'mysql@da-mai.com',
            'tableprefix' => 'cps_',
            'charset' => 'utf8'
        ),

    ),

    'components' => array(
        // URL资源管理器
        'urlManager' => array(
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => array(
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>', // Not Coding Standard
            )
        ),
    )

);