<?php

namespace App\Providers;

use App\Domain\Admin\Models\Admin;
use App\Support\ValuesStore\Setting;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Spatie\Flash\Flash;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'admins' => Admin::class,
        ]);

        Flash::levels([
            'success' => 'success',
            'warning' => 'warning',
            'error' => 'error',
        ]);

        Blade::component('admin.components.formButton', 'form-button');
        Blade::component('admin.components.textField', 'text-field');
        Blade::component('admin.components.selectField', 'select-field');
        Blade::component('admin.components.textareaField', 'textarea-field');
        Blade::component('admin.components.pageHeader', 'page-header');
        Blade::component('admin.components.card', 'card');

        $this->app->singleton(Setting::class, function () {
            return Setting::make(storage_path('app/settings.json'));
        });
    }
}
