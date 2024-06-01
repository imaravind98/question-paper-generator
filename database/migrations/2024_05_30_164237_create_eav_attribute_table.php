<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('eav_attribute', function (Blueprint $table) {
            $table->id();
            $table->text('code');
            $table->text('label');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('eav_entity')->cascadeOnDelete();
            $table->text('type');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('eav_attribute');
        Schema::enableForeignKeyConstraints();
    }
};
