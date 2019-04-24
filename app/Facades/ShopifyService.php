<?php
/**
 * Created by PhpStorm.
 * User: Gev
 * Date: 3/23/19
 * Time: 3:09 PM
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ShopifyService extends Facade{

    protected static function getFacadeAccessor()
    {
        return 'Shopify';
    }
}