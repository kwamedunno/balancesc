<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreCardMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_card_metrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('score_card');
            $table->String('measure');
            $table->double('actual');
            $table->double('target');
            $table->integer('weight');
            $table->timestamp('created_at')->useCurrent(); 
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_card_metrics');
    }
}
