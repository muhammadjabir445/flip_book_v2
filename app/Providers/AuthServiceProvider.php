<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\RoleMenu;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
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

        Gate::define('menu',function($user) {
            $url = '/' . \Request::segment(2);
            $url = Menu::where('url',$url)->first();
            $menu = RoleMenu::where('id_role',$user->id_role)->first();
            $menu = json_decode($menu->parent_menu);
            return in_array($url->id,$menu) ? Response::allow() : Response::deny('You must be a super administrator.');
        });
    }
}
