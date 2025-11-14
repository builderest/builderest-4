<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Helpers\Mailer;
use App\Models\Quote;

class ContactController extends Controller
{
    public function index(): void
    {
        $errors = [];
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $message = trim($_POST['message'] ?? '');

            if ($name === '') {
                $errors['name'] = 'Name is required.';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Provide a valid email.';
            }

            if ($message === '') {
                $errors['message'] = 'Please tell us more about your project.';
            }

            if (empty($errors)) {
                $quoteModel = new Quote();
                $quoteModel->create([
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'service_slug' => null,
                    'message' => $message,
                    'created_at' => date('Y-m-d H:i:s'),
                    'status' => 'new',
                ]);

                $body = '<h2>New contact request</h2>' .
                    '<p><strong>Name:</strong> ' . htmlspecialchars($name) . '</p>' .
                    '<p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>' .
                    '<p><strong>Phone:</strong> ' . htmlspecialchars($phone) . '</p>' .
                    '<p><strong>Message:</strong><br>' . nl2br(htmlspecialchars($message)) . '</p>';

                Mailer::send('info@builderest.com', 'New contact request', $body);
                $success = true;
            }
        }

        $this->view('contact/index', compact('errors', 'success'));
    }
}
