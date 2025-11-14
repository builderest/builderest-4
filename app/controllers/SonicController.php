<?php
namespace App\Controllers;

use App\Core\Controller;

class SonicController extends Controller
{
    public function index(): void
    {
        $this->view('support/index');
    }
}
