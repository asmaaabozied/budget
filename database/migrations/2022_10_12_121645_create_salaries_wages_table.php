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
        Schema::create('salaries_wages', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('basic_salary')->nullable();
            $table->string('hiring_date')->nullable();
            $table->string('variable_transportation')->nullable();
            $table->string('other_allowance')->nullable();
            $table->string('fixed_transportation')->nullable();
            $table->string('incentives')->nullable();
            $table->string('variablefood_allowance')->nullable();
            $table->string('variable_overtime')->nullable();
            $table->string('delay')->nullable();
            $table->string('absence')->nullable();
            $table->string('gross_salary')->nullable();
            $table->string('other_dedutions')->nullable();
            $table->string('unpaid_leave')->nullable();
            $table->string('penalty')->nullable();
            $table->string('social_insurance')->nullable();
            $table->string('totalgross_salary')->nullable();
            $table->string('total_dedction1')->nullable();
            $table->string('annualtaxable_salary')->nullable();
            $table->string('taxable_salary')->nullable();
            $table->string('employee_socialinsurance')->nullable();
            $table->string('net_income')->nullable();
            $table->string('monthly_taxes')->nullable();
            $table->string('annual_taxes')->nullable();
            $table->string('premium_card')->nullable();
            $table->string('mobile_invoice')->nullable();
            $table->string('familymedical_insurance')->nullable();
            $table->string('total_deductions')->nullable();
            $table->string('loan')->nullable();
            $table->string('otherdeductions')->nullable();
            $table->string('finalnet_income')->nullable();
            $table->string('other_allowance2')->nullable();
            $table->string('account_number')->nullable();
            $table->string('pay')->nullable();
            $table->string('totalsocial_insurance')->nullable();
            $table->string('email')->nullable();
            $table->string('id_number')->nullable();
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
        Schema::dropIfExists('salaries_wages');
    }
};
