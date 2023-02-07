<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description', 65535)->nullable();
            $table->string('expected_time')->nullable()->comment('expected time to complete task by seconds');
            $table->string('total_time')->nullable()->comment('total time is a total of task timers by seconds');
            $table->enum('priority', ['normal', 'low', 'medium', 'high', 'highest']);
            $table->integer('order')->nullable();
            $table->integer('progress');
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedInteger('status_id')->nullable();
            $table->unsignedInteger('space_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('owner_id')
                ->references('id')->on('users');

            // these relations could not add now because the tables does not created yet ,,
            // we will create them later in another migration file

//            $table->foreign('status_id')
//                ->references('id')->on('tasks_statuses');
//

//            $table->foreign('space_id')
//                ->references('id')->on('tasks_workspaces');

            //            $table->foreign('company_id')
//                ->references('id')->on('companies');

            //            $table->foreign('branch_id')
//                ->references('id')->on('branches');

            $table->foreign('created_by')
                ->references('id')->on('users');

            $table->foreign('edited_by')
                ->references('id')->on('users');

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
