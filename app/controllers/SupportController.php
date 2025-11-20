<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Faq;

class SupportController extends Controller
{
    public function index(): void
    {
        $faqModel = new Faq();
        $faqs = $faqModel->latest(8);
        $this->view('support/index', compact('faqs'));
    }
}
