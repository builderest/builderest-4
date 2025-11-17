<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Post;

class AdminPostController extends Controller
{
    public function index(): void
    {
        $postModel = new Post();
        $posts = $postModel->all();
        $this->view('admin/posts/index', compact('posts'), 'admin');
    }

    public function create(): void
    {
        $postModel = new Post();
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->formData();

            if (empty($data['title'])) {
                $errors['title'] = 'Title is required.';
            }

            if (empty($errors)) {
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                if ($postModel->create($data)) {
                    $this->redirect('/admin/posts');
                }
            }
        }

        $this->view('admin/posts/form', ['errors' => $errors], 'admin');
    }

    public function edit(string $id): void
    {
        $postModel = new Post();
        $post = $postModel->find($id);

        if (!$post) {
            $this->redirect('/admin/posts');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->formData();

            if (empty($data['title'])) {
                $errors['title'] = 'Title is required.';
            }

            if (empty($errors)) {
                $data['updated_at'] = date('Y-m-d H:i:s');
                if ($postModel->update($id, $data)) {
                    $this->redirect('/admin/posts');
                }
            }
        }

        $this->view('admin/posts/form', compact('post', 'errors'), 'admin');
    }

    public function delete(string $id): void
    {
        $postModel = new Post();
        $postModel->delete($id);
        $this->redirect('/admin/posts');
    }

    private function formData(): array
    {
        return [
            'title' => trim($_POST['title'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'excerpt' => trim($_POST['excerpt'] ?? ''),
            'content' => trim($_POST['content'] ?? ''),
            'thumbnail' => trim($_POST['thumbnail'] ?? ''),
        ];
    }
}
