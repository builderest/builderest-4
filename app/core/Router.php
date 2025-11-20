<?php
namespace App\Core;

class Router
{
    private array $routes = [];
    private array $middlewares = [];
    private array $groupStack = [];

    public function get(string $path, string $action): self
    {
        return $this->addRoute(['GET'], $path, $action);
    }

    public function post(string $path, string $action): self
    {
        return $this->addRoute(['POST'], $path, $action);
    }

    public function match(array $methods, string $path, string $action): self
    {
        return $this->addRoute($methods, $path, $action);
    }

    public function group(string $prefix, callable $callback): self
    {
        $this->groupStack[] = $prefix;
        $callback($this);
        array_pop($this->groupStack);
        return $this;
    }

    public function middleware(string $name): self
    {
        $lastRouteKey = array_key_last($this->routes);
        if ($lastRouteKey !== null) {
            $this->routes[$lastRouteKey]['middlewares'][] = $name;
        }
        return $this;
    }

    public function addRoute(array $methods, string $path, string $action): self
    {
        $prefix = implode('', $this->groupStack);
        $fullPath = $this->normalizePath($prefix . $path);
        $pattern = $this->buildPattern($fullPath);

        $this->routes[] = [
            'methods' => array_map('strtoupper', $methods),
            'path' => $fullPath,
            'action' => $action,
            'pattern' => $pattern,
            'middlewares' => $this->currentGroupMiddlewares(),
        ];

        return $this;
    }

    private function currentGroupMiddlewares(): array
    {
        $middlewares = [];
        foreach ($this->groupStack as $groupPrefix) {
            if (isset($this->middlewares[$groupPrefix])) {
                $middlewares = array_merge($middlewares, $this->middlewares[$groupPrefix]);
            }
        }
        return $middlewares;
    }

    public function groupMiddleware(string $prefix, array $middlewares): void
    {
        $this->middlewares[$prefix] = $middlewares;
    }

    public function dispatch(string $method, string $uri)
    {
        foreach ($this->routes as $route) {
            if (!in_array($method, $route['methods'], true)) {
                continue;
            }

            if (preg_match($route['pattern'], $uri, $matches)) {
                $params = $this->extractParams($matches);
                return [$route['action'], $params, $route['middlewares']];
            }
        }

        return null;
    }

    private function buildPattern(string $path): string
    {
        $pattern = preg_replace('#\{([a-zA-Z0-9_]+)\}#', '(?P<$1>[^/]+)', $path);
        return '#^' . $pattern . '$#';
    }

    private function extractParams(array $matches): array
    {
        $params = [];
        foreach ($matches as $key => $value) {
            if (!is_int($key)) {
                $params[$key] = $value;
            }
        }
        return $params;
    }

    private function normalizePath(string $path): string
    {
        $path = '/' . trim($path, '/');
        return $path === '/' ? '/' : $path;
    }
}
