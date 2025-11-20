<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Guard;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index(): void
    {
        if (!Guard::requireRole('admin')) {
            return;
        }

        $userModel = new User();
        $users = $userModel->all();
        $this->view('admin/users/index', compact('users'), 'admin');
    }

    public function create(): void
    {
        if (!Guard::requireRole('admin')) {
            return;
        }

        $userModel = new User();
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $role = $_POST['role'] ?? 'editor';
            $password = $_POST['password'] ?? '';

            if ($name === '') {
                $errors['name'] = 'Name is required.';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Valid email required.';
            }

            if (strlen($password) < 8) {
                $errors['password'] = 'Password must be at least 8 characters.';
            }

            if (empty($errors)) {
                $userModel->create([
                    'name' => $name,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'role' => $role,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                $this->redirect('/admin/users');
            }
        }

        $this->view('admin/users/form', compact('errors'), 'admin');
    }

    public function edit(string $id): void
    {
        if (!Guard::requireRole('admin')) {
            return;
        }

        $userModel = new User();
        $user = $userModel->find($id);

        if (!$user) {
            $this->redirect('/admin/users');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $role = $_POST['role'] ?? 'editor';
            $password = $_POST['password'] ?? '';

            if ($name === '') {
                $errors['name'] = 'Name is required.';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Valid email required.';
            }

            $data = [
                'name' => $name,
                'email' => $email,
                'role' => $role,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($password !== '') {
                if (strlen($password) < 8) {
                    $errors['password'] = 'Password must be at least 8 characters.';
                } else {
                    $data['password'] = password_hash($password, PASSWORD_DEFAULT);
                }
            }

            if (empty($errors)) {
                $userModel->update($id, $data);
                $this->redirect('/admin/users');
            }
        }

        $this->view('admin/users/form', compact('user', 'errors'), 'admin');
    }

    public function delete(string $id): void
    {
        if (!Guard::requireRole('admin')) {
            return;
        }

        $userModel = new User();
        $userModel->delete($id);
        $this->redirect('/admin/users');
    }
}
