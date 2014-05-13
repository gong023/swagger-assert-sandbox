<?php
$loader = require __DIR__.'/../vendor/autoload.php';
$loader->addPsr4('SandboxTest\\', __DIR__);

\SwaggerAssert\SwaggerAssert::analyze(__DIR__.'/../web/index.php');
