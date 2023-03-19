<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    // nama variabel harus  $singletons
    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Foo::class,function(){
            return new Foo();
        });

        $this->app->singleton(Bar::class,function($app){
            return new Bar($app->make(Foo::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    
    // dipanggil saat dibutuhkan aja. agar bekerja jalankan php artisan clear-compiled dlu
    public function provides()
    {
        return [HelloService::class,Foo::class,Bar::class];
    }
}
