<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helpers/Arrays.php';
        require_once app_path() . '/Helpers/Fechas.php';
        require_once app_path() . '/Helpers/Folders.php';
        require_once app_path() . '/Helpers/Images.php';
        require_once app_path() . '/Helpers/Strings.php';
        require_once app_path() . '/Helpers/Users.php';
        require_once app_path() . '/Helpers/Utilities.php';
        require_once app_path() . '/Helpers/NumbersHelper.php';
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
}
