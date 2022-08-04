<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('machine_name');
            $table->string('machine_id');
            $table->string('style_no');
            $table->date('date');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('buyer_name');
            $table->string('process_name');
            $table->string('actual_result');
            $table->string('actual_target');
            $table->string('achievement');
            $table->integer('status');
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
        Schema::dropIfExists('machines');
    }
}
