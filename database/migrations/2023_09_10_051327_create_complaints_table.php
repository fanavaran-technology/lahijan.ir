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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('national_code');
            $table->string('phone_number');
            $table->string('main_st');
            $table->string('auxiliary_st')->nullable()->comment('خیابان فرعی');
            $table->string('alley')->nullable();
            $table->string('deadend')->nullable();
            $table->string('builing_name')->nullable()->comment('نام مجتمع');
            $table->string('tracking_code');
            $table->longText("description");
            $table->foreignId('department_id')->nullable()->constrained('departments');
            $table->foreignId('reference_id')->nullable()->constrained('users');
            $table->tinyInteger('is_failed')->default(0)->comment('1 is failed');
            $table->longText('answer')->nullable();
            $table->timestamp('referenced_at')->nullable();
            $table->timestamp('answered_at')->nullable();
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
        Schema::dropIfExists('complaints');
    }
};
