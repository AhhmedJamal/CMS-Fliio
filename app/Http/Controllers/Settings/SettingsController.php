<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    protected $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function index()
    {
        return view('settings.index');
    }

    public function update(Request $request)
    {
        // 👈 Validation
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'primary_color' => 'nullable|string|max:7',
            'background_color'=> 'nullable|string|max:7',
            'text_color'=> 'nullable|string|max:7',
        ]);

        // 👈 حفظ النصوص
        $fields = ['store_name', 'primary_color', 'background_color', 'text_color'];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::updateOrCreate(
                    ['key' => $field],
                    ['value' => $request->$field, 'group' => $this->getGroup($field)]
                );
            }
        }

        // 👈 رفع الصورة (طريقة مبسطة)
        if ($request->hasFile('store_logo')) {
            $file = $request->file('store_logo');
            
            // تخزين الصورة
            $path = $file->store('settings', 'public');
            
            if ($path) {
                $url = asset('storage/' . $path);
                
                Setting::updateOrCreate(
                    ['key' => 'store_logo'],
                    ['value' => $url, 'group' => 'general']
                );
            }
        }

        // 👈 مسح الـ Cache
        Cache::forget('site_settings');
        Cache::forget('settings');
        $this->settingsService->refresh();

        return back()->with('success', '✅ تم الحفظ');
    }

    private function getGroup($field)
    {
        $groups = [
            'general' => ['store_name', 'store_tagline', 'store_logo', 'store_favicon'],
            'colors' => ['primary_color', 'secondary_color', 'background_color', 'text_color'],
        ];

        foreach ($groups as $group => $fields) {
            if (in_array($field, $fields)) {
                return $group;
            }
        }

        return 'general';
    }
}