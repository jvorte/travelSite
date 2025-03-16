<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Όνομα του ταξιδιού
            $table->text('description'); // Περιγραφή του ταξιδιού
            $table->text('location');  // Τοποθεσία του ταξιδιού
            $table->string('image1')->nullable(); // Εικόνα 1
            $table->string('image2')->nullable(); // Εικόνα 2
            $table->string('image3')->nullable(); // Εικόνα 3
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trips');
    }
};
