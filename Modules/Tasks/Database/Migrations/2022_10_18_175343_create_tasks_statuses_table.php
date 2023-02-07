<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45)->nullable();
            $table->smallInteger('position')->nullable();
            $table->string('color', 20)->nullable()->default('#000000');
            $table->boolean('is_closed')->nullable();
            $table->boolean('default')->nullable();
            $table->integer('company_id')->unsigned()->nullable()->index('fk_tasks_statuses_company_id_idx');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // these relations could not add now because the tables does not created yet ,, we will create them later in another migration file

            //  $table->foreign('company_id')
            // ->references('id')->on('companies');

            $table->foreign('created_by')
                ->references('id')->on('users');

            $table->foreign('edited_by')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks_statuses');
    }
}
