<?php
try {
    include __DIR__ . '/../helpers/autoload.php';
    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    var_dump($route);
    $method = $_SERVER['REQUEST_METHOD'];
    $apiRoute = new \Api\ApiRoutes();
    $init = new \Framework\Init($route, $method, $apiRoute);
    $init->start();
} catch(PDOException $e){
    $response['title'] = 'Database Error';
    $response['error'] = true;
    $response['message'] = 'A database  error has occured: ' . $e->getMessage() .
               '\nFile: ' . $e->getFile() .
               '\nLine: ' . $e->getLine();
    echo json_encode($response);
}