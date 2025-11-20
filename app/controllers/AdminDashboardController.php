<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Service;
use App\Models\Quote;
use App\Models\Post;

class AdminDashboardController extends Controller
{
    public function index(): void
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
}
