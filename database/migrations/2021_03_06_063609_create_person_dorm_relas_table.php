<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonDormRelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_dorm_relas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personel_id')->constrained('personels');
            $table->foreignId('dorm_id')->constrained('dormitories');
            $table->unique(['personel_id', 'dorm_id']);
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
        Schema::dropIfExists('person_dorm_relas');
    }
}
