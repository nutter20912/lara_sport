<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Request;

class RequestMacroProvider extends ServiceProvider
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
        /**
         * 轉換成 integer 型別
         *
         * @param string $key
         * @param mixed $default
         * @return int
         */
        Request::macro('integer', function ($key, $default = null) {
            return  (int)$this->input($key, $default);
        });
    }
}
