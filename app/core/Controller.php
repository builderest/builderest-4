<?php
namespace App\Core;

class Controller
{
    protected array $data = [];

    protected function view(string $view, array $data = [], string $layout = 'default'): void
    {
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        $layoutPath = __DIR__ . '/../views/layouts/' . $layout . '.php';

        if (!file_exists($viewPath)) {
            throw new \RuntimeException("View {$view} not found");
        }

        $this->data = $data;

        $content = function () use ($viewPath, $data) {
            extract($data, EXTR_SKIP);
            include $viewPath;
        };

        if (file_exists($layoutPath)) {
            extract($data, EXTR_SKIP);
            include $layoutPath;
        } else {
            $content();
        }
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}
