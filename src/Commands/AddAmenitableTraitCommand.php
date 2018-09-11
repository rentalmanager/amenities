<?php
namespace RentalManager\Amenities\Commands;


use RentalManager\Amenities\Traits\Amenitable;
use Traitor\Traitor;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

/**
 * Created by PhpStorm.
 * Date: 7/3/18
 * Time: 2:46 PM
 * AddAmenitablePropertyUseTraitCommand.php
 * @author Goran Krgovic <goran@dashlocal.com>
 */

class AddAmenitableTraitCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'rm:add-amenitable-trait';

    /**
     * Trait added to User model
     *
     * @var string
     */
    protected $targetTrait = Amenitable::class;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $models = $this->getModels();
        foreach ($models as $model) {
            if (!class_exists($model)) {
                $this->error("Class $model does not exist.");
                return;
            }
            if ($this->alreadyUsesTrait($model)) {
                $this->error("Class $model already uses Amenitable.");
                continue;
            }
            Traitor::addTrait($this->targetTrait)->toClass($model);
        }
        $this->info("Amenitable added successfully to {$models->implode(', ')}");
    }

    /**
     * Check if the class already uses LaratrustUserTrait.
     *
     * @param  string  $model
     * @return bool
     */
    protected function alreadyUsesTrait($model)
    {
        return in_array(Amenitable::class, class_uses($model));
    }


    /**
     * Get the description of which clases the LaratrustUserTrait was added.
     *
     * @return string
     */
    public function getDescription()
    {
        return "Add Amenitable to {$this->getModels()->implode(', ')} class";
    }
    /**
     * Return the User models array.
     *
     * @return array
     */
    protected function getModels()
    {
        return new Collection([
            'App\RentalManager\Main\Property',
            'App\RentalManager\Main\Unit'
        ]);
    }



}
