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
        View::composer(['admin.*'], function ($view) {
            $currentRoute = Route::getCurrentRoute()->uri;

            $items = [
                [
                    'label' => 'Plats',
                    'href' => route('admin.plat.index'),
                    'active' => str_contains($currentRoute, 'plat'),
                    'icon' => 'fa-solid fa-utensils'
                ],
                [
                    'label' => 'Ingrédients',
                    'href' => route('admin.ingredient.index'),
                    'active' => str_contains($currentRoute, 'ingredient'),
                    'icon' => 'fa-solid fa-carrot'
                ],
                [
                    'label' => 'Utilisateurs',
                    'href' => route('admin.utilisateur.index'),
                    'active' => str_contains($currentRoute, 'utilisateur'),
                    'icon' => 'fa-solid fa-users'
                ],
                [
                    'label' => 'Roles',
                    'href' => route('admin.role.index'),
                    'active' => str_contains($currentRoute, 'role'),
                    'icon' => 'fa-solid fa-person-circle-question'
                ],
                [
                    'label' => 'Images',
                    'href' => route('admin.image.index'),
                    'active' => str_contains($currentRoute, 'image'),
                    'icon' => 'fa-solid fa-image'
                ]
            ];
            return $view->with('sideBarItems', $items);
        });
    }
}
