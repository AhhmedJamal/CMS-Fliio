<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingsService
{
    protected array $settings = [];

    public function __construct()
    {
        $this->loadSettings();
    }

    protected function loadSettings(): void
    {
        $this->settings = Cache::remember('site_settings', 3600, function () {
            return Setting::all()->pluck('value', 'key')->toArray();
        });
    }

    public function get(string $key, $default = null)
    {
        return $this->settings[$key] ?? $default;
    }

    public function all(): array
    {
        return $this->settings;
    }

    public function getColors(): array
    {
        return [
            'primary' => $this->get('primary_color', '#3B82F6'),
            'secondary' => $this->get('secondary_color', '#10B981'),
            'background' => $this->get('background_color', '#FFFFFF'),
            'text' => $this->get('text_color', '#1F2937'),
        ];
    }

    public function refresh(): void
    {
        // مسح كل الـ Caches
        Cache::forget('site_settings');
        Cache::forget('settings');
        
        // إعادة تحميل الإعدادات
        $this->loadSettings();
    }
}