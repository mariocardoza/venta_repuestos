<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use App\Customer;
use App\Category;
use App\Percentage;
use App\Product;
use App\Purchase;
use App\Receipt;
use App\Observers\UserObserver;
use App\Observers\CustomerObserver;
use App\Observers\CategoryObserver;
use App\Observers\PercentageObserver;
use App\Observers\ProductObserver;
use App\Observers\PurchaseObserver;
use App\Observers\ReceiptObserver;

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
         User::observe(UserObserver::class);
         Customer::observe(CustomerObserver::class);
         Category::observe(CategoryObserver::class);
         Percentage::observe(PercentageObserver::class);
         Product::observe(ProductObserver::class);
         Purchase::observe(PurchaseObserver::class);
         Receipt::observe(ReceiptObserver::class);
    }
}
