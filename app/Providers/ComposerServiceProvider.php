<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $categories = Category::all(['name', 'slug']);
        
        // Compartilhamento simple para todas as views
        // view()->share('categories', $categories);

        // Compartilhamento por função callback
        // view()->composer('*', function($view) use($categories){
        //     $view->with('categories', $categories);
        // });

        // Compartilhamento por arquivo view composer
        view()->composer('layouts.front', 'App\Http\Views\CategoryViewComposer@compose');
    }
}
