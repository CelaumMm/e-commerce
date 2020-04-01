<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \PagSeguro\Library::initialize();
        \PagSeguro\Library::cmsVersion()->setName("E-commerce")->setRelease("1.0.0");
        \PagSeguro\Library::moduleVersion()->setName("E-commerce")->setRelease("1.0.0");

        $categories = Category::all(['name', 'slug']);
        view()->share('categories', $categories);
    }
}
