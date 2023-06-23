<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Order;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        $categories = Cache::remember('home_categories', 5, function () {
            $categories = Category::all();
            return $categories;
        });
        $orders = Cache::remember('orders', 2, function () {
            $orders = Order::where('status', '1')->get();
            return $orders;
        });
        View::share([
            'listCategories' => $categories,
            'accept_orders' => $orders
        ]);
        Schema::defaultStringLength(191);
    }
}
