<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Service;
use App\Models\Post;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index(): void
    {
        $serviceModel = new Service();
        $postModel = new Post();
        $settingModel = new Setting();

        $heroTitle = $settingModel->getValue('hero_title', 'Secure. Automate. Simplify.');
        $heroSubtitle = $settingModel->getValue('hero_subtitle', 'Experts in smart home, security, and business technology.');

        $services = $serviceModel->allOrdered();

        $topServiceSlugs = ['tv-mounting', 'security-cameras', 'projector-installation'];
        $indexedServices = [];
        foreach ($services as $service) {
            $indexedServices[$service['slug']] = $service;
        }

        $topServices = [];
        foreach ($topServiceSlugs as $slug) {
            if (isset($indexedServices[$slug])) {
                $topServices[] = $indexedServices[$slug];
            }
        }

        if (count($topServices) < 3) {
            $topServices = array_slice($services, 0, 3);
        }
        $posts = $postModel->latest(3);

        $this->view('home/index', compact('services', 'topServices', 'posts', 'heroTitle', 'heroSubtitle'));
    }

    public function projects(): void
    {
        $this->view('home/projects', [], 'default');
    }
}
