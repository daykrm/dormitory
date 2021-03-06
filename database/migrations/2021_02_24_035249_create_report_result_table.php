<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_result', function (Blueprint $table) {
            $table->id();
            $table->string('year')->default(date('Y'));
            $table->foreignId('dormitory_id')->constrained('dormitories');
            $table->string('path');
            $table->integer('status')->default(1); // 0 มีสิทธฺ์สัม  1 ประกาศผล 
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
        Schema::dropIfExists('report_result');
    }
}
