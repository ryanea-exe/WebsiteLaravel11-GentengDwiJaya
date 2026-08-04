<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Bagikan $appSetting ke seluruh Blade view
        try {
            $appSetting = Setting::get();
        } catch (\Exception $e) {
            // Jika tabel belum ada (fresh install), gunakan default
            $appSetting = new Setting([
                'app_name' => 'Genteng Dwijaya',
                'app_logo' => null,
            ]);
        }

        View::share('appSetting', $appSetting);
    }
}
