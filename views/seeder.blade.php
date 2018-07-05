<?php echo '<?php' ?>

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalManagerAmenitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Truncating tables');
        $this->truncatePropellerTables();

        // Amenities data
        $amenities = config('amenities_seeder.data');

        foreach ($amenities as $key => $data) {
            // create a new amenity
            $do = \{{ $amenity }}::create($data);
        }
    }

    /**
     * Truncates all the propeller tables
     *
     * @return  void
     */
    public function truncatePropellerTables()
    {
        Schema::disableForeignKeyConstraints();
        \{{ $amenity }}::truncate();
        Schema::enableForeignKeyConstraints();
    }

}