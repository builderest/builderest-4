<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Quote;

class AdminQuoteController extends Controller
{
    public function index(): void
    {
        $quoteModel = new Quote();
        $quotes = $quoteModel->all();
        $this->view('admin/support/quotes', compact('quotes'), 'admin');
    }

    public function updateStatus(string $id): void
    {
        $status = $_POST['status'] ?? 'new';
        $quoteModel = new Quote();
        $quoteModel->update($id, ['status' => $status]);
        $this->redirect('/admin/quotes');
    }
}
