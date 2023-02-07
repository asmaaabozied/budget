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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('family_name')->nullable();
            $table->string('Religion')->nullable();
            $table->string('country')->nullable();
            $table->string('type1')->nullable();
            $table->string('style')->nullable();
            $table->string('brand')->nullable();
            $table->string('color')->nullable();

            $table->text('google2fa_secret')->nullable();

            $table->string('hoppy_date1')->nullable();
            $table->string('hoppy_date2')->nullable();
            $table->string('hoppy_start_date1')->nullable();

            $table->string('hoppy_date3')->nullable();
            $table->string('hoppy_start_date3')->nullable();

            $table->string('hoppy_date4')->nullable();
            $table->string('hoppy_start_date4')->nullable();

            $table->string('hoppy_date5')->nullable();
            $table->string('hoppy_start_date5')->nullable();

            $table->string('hoppy_date_end3')->nullable();
            $table->string('companies')->nullable();
            $table->string('company_en')->nullable();

            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();

            $table->string('types')->nullable();

            $table->string('password')->nullable();
            $table->tinyInteger('status')->default(1);

            $table->integer('company_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('hoppy')->nullable();
            $table->string('job')->nullable();
            $table->string('quality')->nullable();
            $table->string('quality_image')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('image')->nullable();
            $table->string('national')->nullable();

            $table->string('job_term')->nullable();
            $table->string('job_end')->nullable();
            $table->string('type')->nullable();
            $table->string('hours')->nullable();
            $table->string('secret_image')->nullable();
            $table->string('number')->nullable();
            $table->string('currency')->nullable();
            $table->string('salary')->nullable();
            $table->string('housing_allowance')->nullable();
            $table->string('allowance')->nullable();
            $table->string('others')->nullable();
            $table->string('descriptions')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('iban')->nullable();
            $table->string('total')->nullable();
            $table->string('notes')->nullable();
            $table->string('total2')->nullable();
            $table->string('yearly')->nullable();
            $table->string('sick_leave')->nullable();
            $table->string('sustainable_covenant')->nullable();
            $table->string('vacations_balance')->nullable();
            $table->string('Indemnity')->nullable();

            $table->string('image_fish')->nullable();
            $table->string('Insurance_name')->nullable();
            $table->string('Insuranc_start_date')->nullable();
            $table->string('Insuranc_end_date')->nullable();
            $table->string('ID_expiration_date')->nullable();
            $table->string('Contract_expiry_date')->nullable();
            $table->string('Contract_start_date')->nullable();
            $table->string('Termination_type')->nullable();
            $table->string('Insurance_salary')->nullable();
            $table->string('yearly_vacation')->nullable();
            $table->string('Sick_leaves')->nullable();
            $table->string('Opposition_leave')->nullable();
            $table->string('permission_marry')->nullable();
            $table->string('pregnancy_permit')->nullable();
            $table->string('Haj_Vacation')->nullable();
            $table->string('Date_marriage')->nullable();
            $table->string('Trial_end_date')->nullable();
            $table->string('ID_file')->nullable();
            $table->string('ID_expiration_dates')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->userstamps();
            $table->softUserstamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
