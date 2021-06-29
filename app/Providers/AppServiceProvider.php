<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

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
        /** Admin menus */
        $admin_menus = array();
        $pmenus = Menu::where('pid', 2)->orderBy('order_num', 'asc')->get();
        foreach( $pmenus as $pmenu ) {
            $new_pmenu = Menu::get_children($pmenu);
            array_push($admin_menus, $new_pmenu);
        }
        view()->share('admin_menus', $admin_menus);
        /** End ******* */

        /** Common user menus */
        $user_menus = array();
        $pmenus = Menu::where('pid', 3)->orderBy('order_num', 'asc')->get();
        foreach( $pmenus as $pmenu ) {
            $new_pmenu = Menu::get_children($pmenu);
            array_push($user_menus, $new_pmenu);
        }
        view()->share('user_menus', $user_menus);
        /** End ************ */
    }
}
