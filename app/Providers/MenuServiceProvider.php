<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\SubMenus;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Dispatcher $events): void
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $user = auth()->user();
            if ($user->profile == 'admin') {
                $items = $this->getAdminItems();
            } else {
                $items = $this->getUserItems($user->id);
            }


            $event->menu->addAfter(
                'dashboard',
                ...$items
            );
        });
    }

    private function getAdminItems()
    {

        return  app(Menu::class)->select('conf_menu.*')
            ->join('conf_sub_menus', 'conf_sub_menus.menu_id', '=', 'conf_menu.id')
            ->where('conf_menu.actived', true)
            ->groupBy('conf_menu.id')
            ->get()->map(function (Menu $menu) {
                $subItems = app(SubMenus::class)->select('conf_sub_menus.*')
                    ->where('conf_sub_menus.menu_id', $menu['id'])
                    ->get()->map(function (SubMenus $subMenu) {
                        return [
                            'key' => $subMenu['description'],
                            'text' => $subMenu['description'],
                            'route' => $subMenu['route'],
                            'active' => [$subMenu['route']],
                            'icon' => $subMenu['icon'],
                        ];
                    });


                return [
                    'key' => 'menu-' . $menu['id'],
                    'text' => $menu['description'],
                    // 'route'  =>  ['menu',['id'=>$menu['id']]],
                    'active' => ['menu/' . $menu['id'] . '/*'],
                    'icon' => $menu['icon'],
                    'submenu' => [...$subItems]
                ];
            });
    }

    private function getUserItems($userId)
    {

        return  app(Menu::class)->select('conf_menu.*')
            ->join('conf_sub_menus', 'conf_sub_menus.menu_id', '=', 'conf_menu.id')
            ->join('users_permissions', 'users_permissions.sub_menu_id', '=', 'conf_sub_menus.id')
            ->where('conf_menu.actived', true)
            ->where('users_permissions.user_id', $userId)
            ->groupBy('conf_menu.id')
            ->get()->map(function (Menu $menu) use ($userId) {
                $subItems = app(SubMenus::class)->select('conf_sub_menus.*')
                    ->join('users_permissions', 'users_permissions.sub_menu_id', '=', 'conf_sub_menus.id')
                    ->where('conf_sub_menus.menu_id', $menu['id'])
                    ->where('users_permissions.user_id', $userId)
                    ->get()->map(function (SubMenus $subMenu) {
                        return [
                            'key' => $subMenu['description'],
                            'text' => $subMenu['description'],
                            'route' => $subMenu['route'],
                            'active' => [$subMenu['route']],
                            'icon' => $subMenu['icon'],
                        ];
                    });


                return [
                    'key' => 'menu-' . $menu['id'],
                    'text' => $menu['description'],
                    // 'route'  =>  ['menu',['id'=>$menu['id']]],
                    'active' => ['menu/' . $menu['id'] . '/*'],
                    'icon' => $menu['icon'],
                    'submenu' => [...$subItems]
                ];
            });
    }
}
