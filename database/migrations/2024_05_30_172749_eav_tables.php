<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type');
            $table->timestamps();
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('label');
            $table->string('type'); // Add type if needed
            $table->string('value_type')->default('string'); // Add value_type for different value types
            $table->timestamps();
        });

        Schema::create('entity_attribute_value', function (Blueprint $table) {
            $table->foreignId('entity_id');
            $table->foreignId('attribute_id');
            $table->string('string_value')->nullable();
            $table->integer('integer_value')->nullable();
            $table->float('float_value')->nullable();
            $table->boolean('boolean_value')->nullable();
            $table->date('date_value')->nullable();
            // Add columns for other value types as needed
            $table->timestamps();

            $table->primary(['entity_id', 'attribute_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('entity_attribute_value');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('entities');
    }
};