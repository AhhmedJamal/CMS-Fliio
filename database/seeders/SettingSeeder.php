<?php

namespace Database\Seeders;

use App\Models\Setting;  // 👈 أضف الـ use
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // معلومات عامة
            ['key' => 'store_name', 'value' => 'LUVBAG.', 'group' => 'general'],
            ['key' => 'store_tagline', 'value' => 'أفضل المنتجات', 'group' => 'general'],
            ['key' => 'store_logo', 'value' => 'https://res.cloudinary.com/dtrrqx2i0/image/upload/v1783412569/Screenshot_2026-07-07_112340_esn7hw.png', 'group' => 'general'],
            ['key' => 'store_favicon', 'value' => 'https://res.cloudinary.com/dtrrqx2i0/image/upload/v1783412569/Screenshot_2026-07-07_112340_esn7hw.png', 'group' => 'general'],

            // الألوان
            ['key' => 'primary_color', 'value' => '#073D42', 'group' => 'colors'],
            ['key' => 'secondary_color', 'value' => '#10B981', 'group' => 'colors'],
            ['key' => 'background_color', 'value' => '#FFFFFF', 'group' => 'colors'],
            ['key' => 'text_color', 'value' => '#1F2937', 'group' => 'colors'],

            // تواصل
            ['key' => 'phone', 'value' => '+20123456789', 'group' => 'contact'],
            ['key' => 'email', 'value' => 'info@store.com', 'group' => 'contact'],
            ['key' => 'address', 'value' => 'القاهرة، مصر', 'group' => 'contact'],
            ['key' => 'facebook', 'value' => 'https://facebook.com/store', 'group' => 'social'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/store', 'group' => 'social'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}