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
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')
                ->constrained('categories')
                ->onUpdate('cascade');
            $table->string('code', 15)->unique();
            $table->smallInteger('min_question');
            $table->smallInteger('max_question');
            $table->time('allocated_time');
            $table->tinyInteger('min_answers_per_question');
            $table->tinyInteger('max_answers_per_question');
            $table->tinyInteger('difficulty')->index();
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
        Schema::dropIfExists('questionnaires');
    }
};
