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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('body');
            $table->text('image');
            $table->string('slug')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamp('published_at')->nullable();
            $table->bigInteger('view_count')->default(0);
            $table->tinyInteger('is_drfat')->default(0);
            $table->tinyInteger('is_pined')->default(0);
            $table->tinyInteger('is_fire_station')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
};
