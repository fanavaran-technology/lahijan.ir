<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintsTable extends Migration
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
            $table->foreignId('reference_id')->nullable()->constrained('users');
            $table->tinyInteger('is_answered')->default(0)->comment('1 is answered');
            $table->longText('answer')->nullable();
            $table->timestamp('referenced_at')->nullable();
            $table->timestamp('answered_at')->nullable();
            $table->timestamps();
        });

        Schema::create('complaint_user_fails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')->constrained('complaints');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('departement_id')->constrained('departements');
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
        Schema::dropIfExists('complaint_user_fails');
        Schema::dropIfExists('complaints');
    }
}
