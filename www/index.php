<?php
    require '../vendor/autoload.php';
// make a new slim object with view Engine PHPView
    $app = new \Slim\Slim(array(
        'view' => new \PHPView\PHPView(),
        'templates.path' => __DIR__ ));
    $app->get('/', $index = function () use($app) {
        $app->render("index.phtml", array("page" => "index"));
    });
    $app->get('/movie', $index = function () use($app) {
        $app->render("movie.phtml", array("page" => "movie"));
    });
    $app->get('/directions', $index = function () use($app) {
        $app->render("directions.phtml", array("page" => "directions"));
    });
    $app->get('/pics', $index = function () use($app) {
        $app->render("pics.phtml", array("page" => "pics"));
    });
    $app->run();