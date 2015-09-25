<?php
    require '../vendor/autoload.php';
// make a new slim object with view Engine PHPView
    $app = new \Slim\Slim(array(
        'view' => new \PHPView\PHPView(),
        'templates.path' => __DIR__ ));
    $app->get('/', function () {
        echo "Hello World";
    });
    $app->get('/test', function (){
        echo "Testing 123";
    });
    $app->get('/goodbye', function () {
        echo "Goodbye from the web server";
    });
    $app->get('/rocks', function () use($app) {
        $app->render("rocks.phtml");
    });
    $app->run();