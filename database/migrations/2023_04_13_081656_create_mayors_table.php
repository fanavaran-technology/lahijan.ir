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
        Schema::create('mayors', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->unique();
            $table->string('image');
            $table->date('birthdate');
            $table->string('place_birth');
            $table->date('recruitment');
            $table->string('term_responsibility');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('mayors');
    }
};
