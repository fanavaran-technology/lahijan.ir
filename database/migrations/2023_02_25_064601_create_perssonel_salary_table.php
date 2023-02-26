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
        Schema::create('perssonel_salary', function (Blueprint $table) {
            $table->foreignId('perssonel_id')->constrained('perssonels');
            $table->foreignId('salary_subject_id')->constrained('salary_subjects');
            $table->bigInteger('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perssonel_salary');
    }
};
