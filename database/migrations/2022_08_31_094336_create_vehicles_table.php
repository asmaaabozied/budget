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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();

            $table->string('Insurance_name')->nullable();
            $table->string('Insuranc_start_date')->nullable();
            $table->string('ID_expiration_dates')->nullable();
            $table->string('Trial_end_date')->nullable();
            $table->string('yearly_vacation')->nullable();
            $table->string('style')->nullable();
            $table->string('brand')->nullable();
            $table->string('color')->nullable();
            $table->string('start_date')->nullable();
            $table->string('ID_expiration_date')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
};
