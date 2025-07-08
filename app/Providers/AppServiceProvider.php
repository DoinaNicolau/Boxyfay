<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
   
    public function register(): void
    {
        
    }

    
    public function boot(): void
    {
        Paginator::useBootstrap();

        if (Schema::hasTable('categories')) {
            View::share('categories', Category::orderBy('name')->get());
        }
        //  CODICE PER IL CARRELLO
        View::composer('*', function ($view) {
            // Prende il carrello dalla sessione, o un array vuoto se non esiste
            $cart = session()->get('cart', []);
            
            // Calcola la quantità totale
            $cartCount = 0;
            foreach ($cart as $item) {
                $cartCount += $item['quantity'];
            }
            
            // Condivide la variabile 'cartCount' con tutte le view
            $view->with('cartCount', $cartCount);
        });
    }
}
