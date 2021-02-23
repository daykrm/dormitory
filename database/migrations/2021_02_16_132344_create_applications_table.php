<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users');
            $table->string('scholarship_name')->nullable();
            $table->foreignId('dorm_id')->nullable()->constrained('dormitories');
            $table->string('year')->default(date('Y'));
            $table->integer('monthly_expense')->default(0);
            $table->string('underlying_disease')->nullable();
            $table->integer('relative_number')->default(1);
            $table->integer('being_number')->default(1);
            $table->integer('graduated')->default(0);
            $table->integer('in_progress')->default(1);
            $table->string('name_fa');
            $table->integer('age_fa');
            $table->foreignId('occupation_fa')->constrained('occupations');
            $table->string('other_fa')->nullable();
            $table->integer('status_fa')->default(1);
            $table->string('name_mo');
            $table->integer('age_mo');
            $table->foreignId('occupation_mo')->constrained('occupations');
            $table->string('other_mo')->nullable();
            $table->integer('status_mo')->default(1);
            $table->integer('family_monthly_income')->default(0);
            $table->integer('marital_status')->default(1);
            $table->string('name_sp')->nullable();
            $table->integer('age_sp')->nullable();
            $table->foreignId('occupation_sp')->nullable()->constrained('occupations');
            $table->string('other_sp')->nullable();
            $table->integer('monthly_income_sp')->nullable();
            $table->string('relevance')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('applications');
    }
}
