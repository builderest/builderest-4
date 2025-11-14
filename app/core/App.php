<?php
namespace App\Core;

class App
{
    private Router $router;
    private array $middlewareMap = [];

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function registerMiddleware(string $name, callable $handler): void
    {
        $this->middlewareMap[$name] = $handler;
    }

    public function run(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');

        $match = $this->router->dispatch($method, $uri);

        if (!$match) {
            http_response_code(404);
            echo $this->renderError(404, 'Page not found');
            return;
        }

        [$action, $params, $middlewares] = $match;

        foreach ($middlewares as $middleware) {
            if (isset($this->middlewareMap[$middleware])) {
                $result = call_user_func($this->middlewareMap[$middleware]);
                if ($result === false) {
                    return;
                }
            }
        }

        [$controllerName, $methodName] = explode('@', $action);
        $controllerClass = 'App\\Controllers\\' . $controllerName;

        if (!class_exists($controllerClass)) {
            http_response_code(500);
            echo $this->renderError(500, 'Controller not found');
            return;
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $methodName)) {
            http_response_code(500);
            echo $this->renderError(500, 'Controller action not defined');
            return;
        }

        call_user_func_array([$controller, $methodName], $params);
    }

    private function renderError(int $code, string $message): string
    {
        return sprintf('<h1>%d</h1><p>%s</p>', $code, htmlspecialchars($message, ENT_QUOTES));
    }
}
