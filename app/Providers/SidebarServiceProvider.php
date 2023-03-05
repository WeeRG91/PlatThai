<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
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
        View::composer(['ingredient.*', 'plat.*', 'utilisateur.*'], function ($view) {
            $currentRoute = Route::getCurrentRoute()->uri;

            $items = [
                [

                    'label' => 'Plats',
                    'href' => route('plat.index'),
                    'active' => str_contains($currentRoute, 'plat'),
                    'icon' => 'fa-solid fa-utensils'
                ],
                [
                    'label' => 'Ingrédients',
                    'href' => route('ingredient.index'),
                    'active' => str_contains($currentRoute, 'ingredient'),
                    'icon' => 'fa-solid fa-carrot'
                ],
                [
                    'label' => 'Utilisateurs',
                    'href' => route('utilisateur.index'),
                    'active' => str_contains($currentRoute, 'utilisateur'),
                    'icon' => 'fa-solid fa-users'
                ]
            ];
            return $view->with('sideBarItems', $items);
        });
    }
}
