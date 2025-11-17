<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Service;

class AdminServiceController extends Controller
{
    public function index(): void
    {
        $serviceModel = new Service();
        $services = $serviceModel->allOrdered();
        $this->view('admin/services/index', compact('services'), 'admin');
    }

    public function create(): void
    {
        $serviceModel = new Service();
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->formData();
            $errors = $this->validate($data);

            if (empty($errors)) {
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                if ($serviceModel->create($data)) {
                    $this->redirect('/admin/services');
                }
            }
        }

        $this->view('admin/services/form', ['errors' => $errors], 'admin');
    }

    public function edit(string $id): void
    {
        $serviceModel = new Service();
        $service = $serviceModel->find($id);

        if (!$service) {
            $this->redirect('/admin/services');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->formData();
            $errors = $this->validate($data, (int) $id);

            if (empty($errors)) {
                $data['updated_at'] = date('Y-m-d H:i:s');
                if ($serviceModel->update($id, $data)) {
                    $this->redirect('/admin/services');
                }
            }
        }

        $this->view('admin/services/form', compact('service', 'errors'), 'admin');
    }

    public function delete(string $id): void
    {
        $serviceModel = new Service();
        $serviceModel->delete($id);
        $this->redirect('/admin/services');
    }

    private function formData(): array
    {
        return [
            'name' => trim($_POST['name'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'category' => trim($_POST['category'] ?? ''),
            'short_description' => trim($_POST['short_description'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'features' => trim($_POST['features'] ?? ''),
            'starting_price' => (float) ($_POST['starting_price'] ?? 0),
            'icon' => trim($_POST['icon'] ?? ''),
        ];
    }

    private function validate(array $data): array
    {
        $errors = [];

        if ($data['name'] === '') {
            $errors['name'] = 'Name is required.';
        }

        if ($data['slug'] === '') {
            $errors['slug'] = 'Slug is required.';
        }

        if ($data['category'] === '') {
            $errors['category'] = 'Category is required.';
        }

        if ($data['starting_price'] < 0) {
            $errors['starting_price'] = 'Provide a valid price.';
        }

        return $errors;
    }
}
