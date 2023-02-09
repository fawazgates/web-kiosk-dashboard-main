<?php

namespace App\Providers;

use App\Models\Canteen;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

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
        View::composer('layouts.partials.sidebar', function ($view) {
    
            $totalCanteens = Canteen::where('is_deleted', '0')->count();
            return $view->with('totalCanteens', $totalCanteens);
        });
        view()->composer('component._dashboard_superadmin.', function($view)
        {
            $totalCanteens = Canteen::where('is_deleted', '0')->count();
            $view->with('totalCanteens', $totalCanteens);
        });
        if (env('APP_ENV') != 'local') {
            \URL::forceScheme('https');
        } 
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        Blade::directive('currency', function ( $expression ) { return "<?php echo number_format($expression,0,',','.'); ?>"; });
    }
}
