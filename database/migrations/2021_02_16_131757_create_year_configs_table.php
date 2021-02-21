<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateYearConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('year_configs', function (Blueprint $table) {
            // $table->id();
            // $table->string('year');
            // $table->date('startDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            // $table->date('endDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('year_configs');
    }
}
