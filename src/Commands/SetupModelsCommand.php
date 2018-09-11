<?php
namespace RentalManager\Amenities\Commands;


use Illuminate\Console\Command;

/**
 * Class SetupModelsCommand
 * @package Propeller\Commands
 */
class SetupModelsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'rm:setup-models-amenities';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup models';


    /**
     * Commands to call with their description.
     *
     * @var array
     */
    protected $calls = [
        'rm:model-amenity' => 'Creating the amenity model',
    ];

    /**
     * Create a new command instance
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->calls as $command => $info) {
            $this->line(PHP_EOL . $info);
            $this->call($command);
        }
    }
}
