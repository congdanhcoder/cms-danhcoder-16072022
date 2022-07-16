<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use  Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Gallery;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $gallerys = Gallery::orderBy('id', 'DESC')->paginate(10);
        $allGallery = count(Gallery::all());
        if ($allGallery <= 10) {
            $btnMore = "none";
        } else {
            $btnMore = "block";
        }
        view::share([
            'gallerys' => $gallerys,
            'btnMore' => $btnMore
        ]);

        //
    }
}
