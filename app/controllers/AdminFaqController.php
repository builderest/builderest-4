<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Faq;

class AdminFaqController extends Controller
{
    public function index(): void
    {
        $faqModel = new Faq();
        $faqs = $faqModel->all();
        $this->view('admin/support/faqs', compact('faqs'), 'admin');
    }

    public function create(): void
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

    public function edit(string $id): void
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

    public function delete(string $id): void
    {
        $faqModel = new Faq();
        $faqModel->delete($id);
        $this->redirect('/admin/faqs');
    }
}
