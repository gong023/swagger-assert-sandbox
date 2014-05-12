<?php
$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

/**
 * @SWG\Resource(
 *     resourcePath="plain",
 *     @SWG\Api(
 *         path="/plain",
 *         description="plain api structure",
 *         @SWG\Operation(
 *             method="GET",type="SimpleMember",nickname="plain"
 *         )
 *     )
 * )
 *
 * @SWG\Model(
 *     id="SimpleMember",
 *     @SWG\Property(name="id", type="integer", required=true, description="user id"),
 *     @SWG\Property(name="name", type="string", required=true, description="user name")
 * )
 */
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
