<?php
namespace Framework;
class Init{
    private $route;
    private $routes;
    private $method;

    public function __construct(string $route,  string $method,  $routes){
        $this->route = $route;
        $this->routes = $routes;
        $this->method = $method;
        $this->checkUrl();
    }
    private function checkUrl(){
        if ($this->route !== strtolower($this->route)){
            http_response_code(301);
            header('location: ' . strtolower($this->route));
        }
    }
    private function getResponseData($variables = []){
        extract($variables);
        ob_start();
        return ob_get_clean();
    }
    public function start(){
        $response = [];
        $auth = $this->routes->getAuth();
        $routes = $this->routes->getRoutes();
        $action = $routes[$this->route][$this->method]['action'];
        $controller = $routes[$this->route][$this->method]['controller'];
        $result = $controller->$action();
        if (isset($result['variables'])){
            $response[] = $this->getResponseData($result['variables']);
        }
        echo json_encode($result['variables']);
    }
}