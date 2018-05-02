<?php

namespace Softce\Banner\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class BannerServiceProvider extends ServiceProvider
{

    public function boot(){
        $this->loadRoutesFrom(dirname(__DIR__).'\routes\web.php');
        $this->loadViewsFrom(dirname(__DIR__) . '\views', 'banner');
        $this->loadMigrationsFrom(dirname(__DIR__) . '/migrations');

        $slider = DB::table('admin_menus')->where('name', 'Баннер')->first();
        if(is_null($slider)){
            DB::table('admin_menus')->insert([
                'admin_menu_id' => 5,
                'name' => 'Баннер',
                'icon' => 'fa-image',
                'route' => 'admin.banner.index',
                'o' => 0
            ]);
        }
    }

    public function register(){
        //
    }

}