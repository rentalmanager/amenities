<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RentalManagerAmenitiesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenities', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type', 20)->index();
            $table->string('group',20)->index();
            $table->text('standardization')->nullable();
            $table->timestamps();
        });

        Schema::create('amenity_node', function(Blueprint $table) {
            $table->unsignedInteger('amenity_id');
            $table->unsignedInteger('node_id')->index();
            $table->string('node_type');
            $table->foreign('amenity_id')->references('id')->on('amenities')->onDelete('cascade');
            $table->primary(['amenity_id', 'node_id', 'node_type']);
        });


    }

    public function down()
    {
        Schema::dropIfExists('amenities');
        Schema::dropIfExists('amenity_node');
    }

}
