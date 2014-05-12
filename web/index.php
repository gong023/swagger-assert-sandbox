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

/**
 * @SWG\Resource(
 *     resourcePath="nested",
 *     @SWG\Api(
 *         path="/nested",
 *         description="nested api structure",
 *         @SWG\Operation(
 *             method="GET",type="NestedMember",nickname="nested"
 *         )
 *     )
 * )
 *
 * @SWG\Model(
 *     id="NestedMember",
 *     @SWG\Property(name="id", type="integer", required=true, description="user id"),
 *     @SWG\Property(name="name", type="string", required=true, description="user name"),
 *     @SWG\Property(name="birth", type="Birth", required=true, description="birth day,month")
 * )
 *
 * @SWG\Model(
 *     id="Birth",
 *     @SWG\Property(name="month", type="string", required=true, description="month"),
 *     @SWG\Property(name="day", type="integer", required=true, description="day")
 * )
 */
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

/**
 * @SWG\Resource(
 *     resourcePath="collection",
 *     @SWG\Api(
 *         path="/collection",
 *         description="nested api structure",
 *         @SWG\Operation(
 *             method="GET",type="CollectionMember",nickname="collection"
 *         )
 *     )
 * )
 *
 * @SWG\Model(
 *     id="CollectionMember",
 *     @SWG\Property(
 *          name="member collection",
 *          type="array",
 *          @SWG\Items("SimpleMember"),
 *          required=true,
 *          description="member array"
 *      )
 * )
 */
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

/**
 * @SWG\Resource(
 *     resourcePath="parameter",
 *     @SWG\Api(
 *         path="/parameter/{id}",
 *         description="nested api structure",
 *         @SWG\Operation(
 *             method="GET",type="SimpleMember",nickname="nested",
 *             @SWG\Parameters(
 *                 @SWG\Parameter(
 *                     name="id", paramType="path",type="string",
 *                     required=true, description="specify member id"
 *                 )
 *             )
 *         )
 *     )
 * )
 */
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

$app->get('/swagger-ui', function () use ($app) {
    return file_get_contents(__DIR__.'/../views/swagger-ui/index.html');
});

$app->run();
