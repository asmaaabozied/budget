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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('hoppy_end_date3')->nullable();

            $table->string('hoppy_start_date2')->nullable();
            $table->string('tax_numbers')->nullable();
            $table->string('tax_type')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('status_insure')->nullable();
            $table->string('name_insure')->nullable();
            $table->string('number2')->nullable();
            $table->string('user_id')->nullable();

            $table->string('tax_type_date')->nullable();
            $table->string('date3')->nullable();
            $table->string('status_insure_date')->nullable();
            $table->string('date4')->nullable();
            $table->string('Transportation_allowances')->nullable();
            $table->string('housing_allowances')->nullable();

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
        Schema::dropIfExists('employees');
    }
};
