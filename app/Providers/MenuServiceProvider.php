<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    $adminMenuJson = file_get_contents(base_path('resources/menu/adminMenu.json'));
    $adminMenuData = json_decode($adminMenuJson);
    $clientMenuJson = file_get_contents(base_path('resources/menu/clientMenu.json'));
    $clientMenuData = json_decode($clientMenuJson);
    // $horizontalMenuJson = file_get_contents(base_path('resources/menu/horizontalMenu.json'));
    // $horizontalMenuData = json_decode($horizontalMenuJson);

    // Share all menuData to all the views
    \View::share('menuData', [$adminMenuData, $clientMenuData]);
  }
}
