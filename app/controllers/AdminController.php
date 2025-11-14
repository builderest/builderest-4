<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Helpers\Auth as AuthHelper;
use App\Models\Service;
use App\Models\Post;
use App\Models\Quote;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard(): void
    {
        $serviceModel = new Service();
        $quoteModel = new Quote();
        $postModel = new Post();

        $stats = [
            'services' => count($serviceModel->all()),
            'quotes' => count($quoteModel->all()),
            'posts' => count($postModel->all()),
        ];

        $latestQuotes = $quoteModel->latest(5);

        $this->view('admin/dashboard', compact('stats', 'latestQuotes'), 'admin');
    }

    public function services(): void
    {
        $serviceModel = new Service();
        $services = $serviceModel->allOrdered();
        $this->view('admin/services/index', compact('services'), 'admin');
    }

    public function createService(): void
    {
        $serviceModel = new Service();
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->serviceFormData();
            $errors = $this->validateService($data);

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

    public function editService(string $id): void
    {
        $serviceModel = new Service();
        $service = $serviceModel->find($id);

        if (!$service) {
            $this->redirect('/admin/services');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->serviceFormData();
            $errors = $this->validateService($data, (int) $id);

            if (empty($errors)) {
                $data['updated_at'] = date('Y-m-d H:i:s');
                if ($serviceModel->update($id, $data)) {
                    $this->redirect('/admin/services');
                }
            }
        }

        $this->view('admin/services/form', compact('service', 'errors'), 'admin');
    }

    public function deleteService(string $id): void
    {
        $serviceModel = new Service();
        $serviceModel->delete($id);
        $this->redirect('/admin/services');
    }

    private function serviceFormData(): array
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

    private function validateService(array $data, ?int $id = null): array
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

    public function posts(): void
    {
        $postModel = new Post();
        $posts = $postModel->all();
        $this->view('admin/posts/index', compact('posts'), 'admin');
    }

    public function createPost(): void
    {
        $postModel = new Post();
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->postFormData();

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

    public function editPost(string $id): void
    {
        $postModel = new Post();
        $post = $postModel->find($id);

        if (!$post) {
            $this->redirect('/admin/posts');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->postFormData();

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

    public function deletePost(string $id): void
    {
        $postModel = new Post();
        $postModel->delete($id);
        $this->redirect('/admin/posts');
    }

    private function postFormData(): array
    {
        return [
            'title' => trim($_POST['title'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'excerpt' => trim($_POST['excerpt'] ?? ''),
            'content' => trim($_POST['content'] ?? ''),
            'thumbnail' => trim($_POST['thumbnail'] ?? ''),
        ];
    }

    public function quotes(): void
    {
        $quoteModel = new Quote();
        $quotes = $quoteModel->all();
        $this->view('admin/support/quotes', compact('quotes'), 'admin');
    }

    public function updateQuoteStatus(string $id): void
    {
        $status = $_POST['status'] ?? 'new';
        $quoteModel = new Quote();
        $quoteModel->update($id, ['status' => $status]);
        $this->redirect('/admin/quotes');
    }

    public function faqs(): void
    {
        $faqModel = new Faq();
        $faqs = $faqModel->all();
        $this->view('admin/support/faqs', compact('faqs'), 'admin');
    }

    public function createFaq(): void
    {
        $faqModel = new Faq();
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $question = trim($_POST['question'] ?? '');
            $answer = trim($_POST['answer'] ?? '');

            if ($question === '' || $answer === '') {
                $errors['question'] = 'Question and answer are required.';
            } else {
                $faqModel->create([
                    'question' => $question,
                    'answer' => $answer,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                $this->redirect('/admin/faqs');
            }
        }

        $this->view('admin/support/faq-form', compact('errors'), 'admin');
    }

    public function editFaq(string $id): void
    {
        $faqModel = new Faq();
        $faq = $faqModel->find($id);
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $question = trim($_POST['question'] ?? '');
            $answer = trim($_POST['answer'] ?? '');

            if ($question === '' || $answer === '') {
                $errors['question'] = 'Question and answer are required.';
            } else {
                $faqModel->update($id, [
                    'question' => $question,
                    'answer' => $answer,
                ]);
                $this->redirect('/admin/faqs');
            }
        }

        $this->view('admin/support/faq-form', compact('faq', 'errors'), 'admin');
    }

    public function deleteFaq(string $id): void
    {
        $faqModel = new Faq();
        $faqModel->delete($id);
        $this->redirect('/admin/faqs');
    }

    public function settings(): void
    {
        $settingModel = new Setting();
        $status = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $keys = ['hero_title', 'hero_subtitle', 'contact_phone', 'contact_email', 'contact_address', 'social_facebook', 'social_instagram', 'social_tiktok', 'social_youtube'];

            foreach ($keys as $key) {
                $settingModel->setValue($key, trim($_POST[$key] ?? ''));
            }

            $status = 'Settings updated successfully.';
        }

        $settings = [];
        foreach (['hero_title', 'hero_subtitle', 'contact_phone', 'contact_email', 'contact_address', 'social_facebook', 'social_instagram', 'social_tiktok', 'social_youtube'] as $key) {
            $settings[$key] = $settingModel->getValue($key, '');
        }

        $this->view('admin/settings/index', compact('settings', 'status'), 'admin');
    }

    public function users(): void
    {
        $this->ensureAdmin();
        $userModel = new User();
        $users = $userModel->all();
        $this->view('admin/users/index', compact('users'), 'admin');
    }

    public function createUser(): void
    {
        $this->ensureAdmin();
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

    public function editUser(string $id): void
    {
        $this->ensureAdmin();
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

    public function deleteUser(string $id): void
    {
        $this->ensureAdmin();
        $userModel = new User();
        $userModel->delete($id);
        $this->redirect('/admin/users');
    }

    private function ensureAdmin(): void
    {
        if (($_SESSION['admin_role'] ?? '') !== 'admin') {
            $this->redirect('/admin');
        }
    }
}
