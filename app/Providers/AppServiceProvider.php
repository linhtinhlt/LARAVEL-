<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Sử dụng view composer để chia sẻ biến categories với tất cả các views
        View::composer('*', function ($view) {
           $categories = Category::whereNull('parent_id')->with('children')->get();

            $view->with('categories', $categories);
        });
    }
}
