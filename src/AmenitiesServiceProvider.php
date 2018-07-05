<?php
namespace RentalManager\Amenities;

use Illuminate\Support\ServiceProvider;

/**
 * Created by PhpStorm.
 * Date: 7/3/18
 * Time: 2:09 PM
 * AmenityServiceProvider.php
 * @author Goran Krgovic <goran@dashlocal.com>
 */

class AmenitiesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        'Migration' => 'command.amenities.migration',
        'MakeAmenity' => 'command.amenities.amenity',
        'SetupModels' => 'command.amenities.setup-models',
        'Setup' => 'command.amenities.setup',
        'Seeder' => 'command.amenities.seeder',
        'AddAmenitableTrait' => 'command.amenities.add-amenitable-trait'
    ];

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Merge config file for the current app
        $this->mergeConfigFrom(__DIR__.'/../config/amenities.php', 'amenities');

        // Publish the config files
        $this->publishes([
            __DIR__.'/../config/amenities.php' => config_path('amenities.php'),
            __DIR__.'/../config/amenities_seeder.php' => config_path('amenities_seeder.php')
        ], 'amenities');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // Register the app
        $this->registerApp();

        // Register Commands
        $this->registerCommands();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerApp()
    {
        $this->app->bind('amenities', function ($app) {
            return new Amenities($app);
        });

        $this->app->alias('amenities', 'RentalManager\Amenities');
    }

    /**
     * Register the given commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        foreach (array_keys($this->commands) as $command) {
            $method = "register{$command}Command";
            call_user_func_array([$this, $method], []);
        }
        $this->commands(array_values($this->commands));
    }

    protected function registerMigrationCommand()
    {
        $this->app->singleton('command.amenities.migration', function () {
            return new \RentalManager\Amenities\Commands\MigrationCommand();
        });
    }

    protected function registerSeederCommand()
    {
        $this->app->singleton('command.amenities.seeder', function () {
            return new \RentalManager\Amenities\Commands\SeederCommand();
        });
    }

    protected function registerSetupCommand()
    {
        $this->app->singleton('command.amenities.setup', function () {
            return new \RentalManager\Amenities\Commands\SetupCommand();
        });
    }

    protected function registerSetupModelsCommand()
    {
        $this->app->singleton('command.amenities.setup-models', function () {
            return new \RentalManager\Amenities\Commands\SetupModelsCommand();
        });
    }

    protected function registerMakeAmenityCommand()
    {
        $this->app->singleton('command.amenities.amenity', function ($app) {
            return new \RentalManager\Amenities\Commands\MakeAmenityCommand($app['files']);
        });
    }


    protected function registerAddAmenitableTraitCommand()
    {
        $this->app->singleton('command.amenities.add-amenitable-trait', function () {
            return new \RentalManager\Amenities\Commands\AddAmenitableTraitCommand();
        });
    }

    /**
     * Get the services provided.
     *
     * @return array
     */
    public function provides()
    {
        return array_values($this->commands);
    }
}