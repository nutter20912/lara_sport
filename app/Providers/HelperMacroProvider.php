<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class HelperMacroProvider extends ServiceProvider
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
         * 陣列解構
         *
         * @param array $array
         * @param array $destructuringKeys
         * @return array
         */
        Arr::macro('list', function ($array, $destructuringKeys) {
            return array_map(fn ($key) => $array[$key] ?? null, $destructuringKeys);
        });
    }
}
