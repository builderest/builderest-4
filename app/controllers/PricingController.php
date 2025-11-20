<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Service;

class PricingController extends Controller
{
    public function index(): void
    {
        $serviceModel = new Service();
        $services = $serviceModel->allOrdered();
        $this->view('pricing/index', compact('services'));
    }
}
