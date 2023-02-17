<?php

namespace App\Providers;

use App\Nova\Post;
use App\Nova\User;
use Laravel\Nova\Nova;
use Illuminate\Http\Request;
use App\Nova\Dashboards\Main;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Acme\PriceTracker\PriceTracker;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;


class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::style('my-theme', public_path('build/assets/nova.css'));

        $this->app->alias(
            \App\Http\Controllers\Nova\LoginController::class,
            \Laravel\Nova\Http\Controllers\LoginController::class
        );


        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),

                MenuSection::make('Human Resourse', [
                    MenuItem::resource(User::class),
                    MenuItem::resource(Post::class),
                ])->icon('user')->collapsable(),

                MenuSection::make('Project Controls', [
                    MenuItem::resource(User::class),
                    MenuItem::resource(Post::class),
                ])->icon('document-text')->collapsable(),


                MenuSection::make('IT Support')->path('/price-tracker'),
                MenuSection::make('Quality Control')->path('/price-tracker'),

                MenuSection::make('Configuration', [
                    MenuItem::resource(User::class),
                ])->icon('cog')->collapsable(),

            ];
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true;
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
           new PriceTracker
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
