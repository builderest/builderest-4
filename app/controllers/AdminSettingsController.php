<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Setting;

class AdminSettingsController extends Controller
{
    public function index(): void
    {
        $settingModel = new Setting();
        $status = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $keys = [
                'hero_title',
                'hero_subtitle',
                'contact_phone',
                'contact_email',
                'contact_address',
                'social_facebook',
                'social_instagram',
                'social_tiktok',
                'social_youtube',
            ];

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
}
