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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('user_id')->nullable();

            $table->string('email')->nullable();
            $table->string('activity')->nullable();
            $table->string('description')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('manger_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('currency_id')->nullable();
            $table->enum('type', ['company', 'branch', 'project'])->nullable();

            $table->string('number')->nullable();
            $table->string('number_image')->nullable();

            $table->string('commerical_number')->nullable();
            $table->string('commerical_image')->nullable();

            $table->string('number_hoppy')->nullable();
            $table->string('hoppy_image')->nullable();

            $table->string('tax')->nullable();
            $table->string('tax_image')->nullable();

            $table->string('linces')->nullable();
            $table->string('linces_image')->nullable();

            $table->string('work_number')->nullable();
            $table->string('work_image')->nullable();

            $table->string('row_number')->nullable();
            $table->string('row_image')->nullable();

            $table->string('iban')->nullable();
            $table->string('iban_image')->nullable();

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
        Schema::dropIfExists('branches');
    }
};
