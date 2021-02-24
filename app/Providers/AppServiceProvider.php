<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
//      会发现样式错乱，这是因为默认 Laravel 分页没有使用 Bootstrap ，我们只需要在 AppServiceProvider 中设置使用 Bootstrap 即可：
        \Illuminate\Pagination\Paginator::useBootstrap();
        Schema::defaultStringLength(191);
    }
}
