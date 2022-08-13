<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('organization');
            $table->string('property_type');
            $table->integer('uprn');
            $table->string('address');
            $table->string('town');
            $table->string('postcode');
            $table->boolean('live');
            $table->timestamps();
        });

        Schema::table('properties', function (Blueprint $table){
           $table->foreignId('parent_property_id')->constrained('properties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
