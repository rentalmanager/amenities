<?php echo '<?php' ?>

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RentalManagerAmenitiesSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Create table for the property identifications
        Schema::create('{{ $amenities['tables']['amenities'] }}', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('type', 20)->index();
                $table->string('group',20)->index();
                $table->text('standardization')->nullable();
                $table->timestamps();
        });

        // Pivot table
        Schema::create('{{ $amenities['tables']['amenity_nodes'] }}', function(Blueprint $table) {
            $table->unsignedInteger('{{ $amenities['foreign_keys']['amenity'] }}');
            $table->unsignedInteger('node_id')->index();
            $table->string('node_type');

            $table->foreign('{{ $amenities['foreign_keys']['amenity'] }}')->references('id')->on('{{ $amenities['tables']['amenities'] }}')->onDelete('cascade');
            $table->primary(['{{ $amenities['foreign_keys']['amenity'] }}', 'node_id', 'node_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('{{ $amenities['tables']['amenities'] }}');
        Schema::dropIfExists('{{ $amenities['tables']['amenity_nodes'] }}');
    }
}