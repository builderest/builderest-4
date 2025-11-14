<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(): void
    {
        $serviceModel = new Service();
        $services = $serviceModel->allOrdered();
        $this->view('services/index', compact('services'));
    }

    public function show(string $slug): void
    {
        $serviceModel = new Service();
        $service = $serviceModel->findBySlug($slug);

        if (!$service) {
            http_response_code(404);
            $this->view('services/show', ['service' => null]);
            return;
        }

        $related = array_filter($serviceModel->allOrdered(), fn($s) => $s['slug'] !== $service['slug']);
        $this->view('services/show', compact('service', 'related'));
    }
}
