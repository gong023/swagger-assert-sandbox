<?php
$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app->get('/plain', function () use ($app) {
    $response = [
        'id'   => 0,
        'name' => 'kohsaka'
    ];

    return $app->json($response);
});

$app->get('/nested', function () use ($app) {
    $response = [
        'id'    => 0,
        'name'  => 'kohsaka',
        'birth' => [
            'month' => 'August',
            'day'   => '3'
        ]
    ];

    return $app->json($response);
});

$app->get('/collection', function () use ($app) {
    $response = [
        [
            'id'   => 0,
            'name' => 'kohsaka'
        ],
        [
            'id'   => 1,
            'name' => 'sonoda'
        ],
        [
            'id'   => 2,
            'name' => 'minami'
        ]
    ];

    return $app->json($response);
});

$app->get('/parameter/{id}', function ($id) use ($app) {
    $index = [
        [
            'id'   => 0,
            'name' => 'kohsaka'
        ],
        [
            'id'   => 1,
            'name' => 'sonoda'
        ],
        [
            'id'   => 2,
            'name' => 'minami'
        ]
    ];

    return $app->json($index[$id]);
});

$app->run();
