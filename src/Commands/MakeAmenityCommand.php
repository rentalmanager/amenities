<?php
namespace RentalManager\Amenities\Commands;


use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Config;

class MakeAmenityCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'rm:model-amenity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Amenity model if it does not exist';


    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Amenity model';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__. '/../../stubs/amenity.stub';
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return 'App\RentalManager\AddOns\Amenity';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }
}
