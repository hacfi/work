<?php

$container->loadFromExtension(
    'framework',
    array(
        'templating' => array(
            'packages' => array(
                'style' => array(
                    'version' => file_exists(__DIR__.'/../../web/css/style.css') ? substr(sha1_file(__DIR__.'/../../web/css/style.css'), 0, 6) : md5(time())
                ),
            )
        ),
    )
);
