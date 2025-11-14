<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Post;

class BlogController extends Controller
{
    public function index(): void
    {
        $postModel = new Post();
        $posts = $postModel->all();
        $this->view('blog/index', compact('posts'));
    }

    public function show(string $slug): void
    {
        $postModel = new Post();
        $post = $postModel->findBySlug($slug);

        if (!$post) {
            http_response_code(404);
            $this->view('blog/show', ['post' => null]);
            return;
        }

        $this->view('blog/show', compact('post'));
    }
}
