<?php

namespace App\Providers;

use App\Http\Services\SettingService;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use App\Models\Role;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

    }
    // thiết lập phân quyền
    private function setupRBAC(){
        $roles = Role::with('permissions')->get();
        $permissionsArray = [];
        // gán các quyền với role  tương ứng
        foreach ($roles as $role) {
            foreach ($role->permissions as $permissions) {
                $permissionsArray[$permissions->name][$role->id]= true;
            }
        }
        // Every permission may have multiple roles assigned
        foreach ($permissionsArray as $name => $roles) {
            // Định nghĩa các quyền người dùng
            Gate::define($name, function ($user) use ($name,$permissionsArray){
                // We check if we have the needed roles among current user's roles
                return isset($permissionsArray[$name][$user->role->id]);
            });
        }
        // Kiểm tra xem có quyền admin không
        $gate = array_filter(Gate::abilities(), function ($var, $key) {
            return  str_contains($key, 'admin');
        }, ARRAY_FILTER_USE_BOTH);
        Gate::define('admin', function ($user) use ($gate) {

            //check if admin site
            foreach ($gate as  $key => $value) {

                if (Gate::any($key)) {
                    return true;
                }
            }
            return false;
        });
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        //
        App::setLocale('vi');
        try {
            /** set time zone */
//            Config::set('app.timezone', $generalSetting->time_zone);
            //role & permissions
            $this->setupRBAC();
            SettingService::initSetting();
            $generalSetting = SettingService::getGeneralSetting();
            $logoSetting = SettingService::getLogoSetting();
            /** Share variable at all view */
            if(isset($generalSetting, $logoSetting))
            {
                View::composer('admin.*', function ($view) use ($generalSetting,$logoSetting){

                    $view->with(['settings' => $generalSetting, 'logoSetting' => $logoSetting]);
                });
                View::composer('frontend.dashboard.order.print', function ($view) use ($generalSetting,$logoSetting){

                    $view->with(['settings' => $generalSetting, 'logoSetting' => $logoSetting]);
                });
                View::composer('templates.clients.frontend', function ($view) use ($generalSetting,$logoSetting){

                    $view->with(['settings' => $generalSetting, 'logoSetting' => $logoSetting]);
                });
            }

        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

    }
}
