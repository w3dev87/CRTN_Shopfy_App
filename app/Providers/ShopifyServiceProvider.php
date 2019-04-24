<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class  ShopifyServiceProvider extends ServiceProvider{

    public function register(){
        $this->app->bind('Shopify', 'App\Services\Shopify');
    }
}