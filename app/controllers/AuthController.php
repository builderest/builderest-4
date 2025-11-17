<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Helpers\Mailer;
use App\Models\User;

class AuthController extends Controller
{
    public function login(): void
    {
        if (Auth::check()) {
            $this->redirect('/admin');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if (!$user || !password_verify($password, $user['password'])) {
                $errors['general'] = 'Invalid credentials. Please try again.';
            } else {
                Auth::login($user);
                $this->redirect('/admin');
            }
        }

        $this->view('admin/login', ['errors' => $errors, 'standalone' => true], 'admin');
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect('/admin/login');
    }

    public function forgot(): void
    {
        $errors = [];
        $status = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Enter a valid email address.';
            } else {
                $userModel = new User();
                $user = $userModel->findByEmail($email);

                if ($user) {
                    $token = bin2hex(random_bytes(32));
                    $expires = date('Y-m-d H:i:s', time() + 3600);
                    $userModel->setResetToken((int) $user['id'], $token, $expires);

                    $resetUrl = APP_URL . '/password/reset?token=' . urlencode($token);
                    $body = '<p>Hello ' . htmlspecialchars($user['name']) . ',</p>' .
                        '<p>We received a request to reset your password. Click the button below to create a new one.</p>' .
                        '<p><a href="' . $resetUrl . '" style="background:#0055ff;color:#fff;padding:12px 24px;text-decoration:none;border-radius:6px;">Reset Password</a></p>' .
                        '<p>If you did not request this, you can ignore this email.</p>';

                    Mailer::send($email, 'Reset your Builderest password', $body);
                }

                $status = 'If an account exists for that email, a password reset link has been sent.';
            }
        }

        $this->view('admin/password-forgot', ['errors' => $errors, 'status' => $status, 'standalone' => true], 'admin');
    }

    public function reset(): void
    {
        $errors = [];
        $status = null;
        $token = $_GET['token'] ?? ($_POST['token'] ?? '');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['password_confirmation'] ?? '';

            if ($password === '' || strlen($password) < 8) {
                $errors['password'] = 'Password must be at least 8 characters.';
            }

            if ($password !== $confirm) {
                $errors['password_confirmation'] = 'Passwords do not match.';
            }

            if (empty($errors)) {
                $userModel = new User();
                $user = $userModel->findByToken($token);

                if (!$user) {
                    $errors['token'] = 'Invalid or expired token.';
                } elseif (strtotime($user['reset_expires_at'] ?? '1970-01-01') < time()) {
                    $errors['token'] = 'This reset token has expired.';
                } else {
                    $hashed = password_hash($password, PASSWORD_DEFAULT);
                    $userModel->updatePassword((int) $user['id'], $hashed);
                    $status = 'Password updated successfully. You can now log in.';
                }
            }
        }

        $this->view('admin/password-reset', ['errors' => $errors, 'status' => $status, 'token' => $token, 'standalone' => true], 'admin');
    }
}
