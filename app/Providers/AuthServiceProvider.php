<?php

namespace App\Providers;

use App\Models\Author;
use App\Models\Product;
use App\Policies\AuthorPolicy;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
        Author::class => AuthorPolicy::class,
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-product', function ($user, $product){
            if ($user->id == $product->user_id) {
                return true;
            } else {
                return false;
            }
//            return $user->id == $product->user_id;
        });
        Gate::define('show-users-list', function ($user){
            if ($user->role == 0) {
                return true;
            } else {
                return false;
            }
        });
    }
}
