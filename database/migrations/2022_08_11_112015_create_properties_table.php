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
            $table->foreignId('parent_property_id')->nullable()->constrained('properties')->cascadeOnDelete();
            $table->string('organisation');
            $table->string('property_type');
            $table->integer('uprn');
            $table->string('address');
            $table->string('town')->nullable();
            $table->string('postcode')->nullable();
            $table->boolean('live');
            $table->timestamps();
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
