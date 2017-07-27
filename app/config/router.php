<?php

$router = $di->getRouter();

// Define your routes here

$router->handle();

$router->add(
    "/article/:action/:params",
    [
        "controller" => 'article',
        "action"     => 1,
        "params"     => 2,
    ]
);

$router->add(
    "/logout",
    [
        "controller" => 'login',
        "action" => 'logout'
    ]
);
$router->add(
    "/writeArticle",
    [
        "controller" => 'article',
        "action" => 'writeApi'
    ]
);

$router->add(
    "/uploadImage",
    [
        "controller" => 'upload',
        "action" => 'image'
    ]
);

$router->add(
    "/download/:params",
    [
        "controller" => 'upload',
        "action" => 'download',
        "params" => 1
    ]
);
