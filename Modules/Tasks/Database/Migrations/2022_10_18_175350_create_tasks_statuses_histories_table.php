<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksStatusesHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_statuses_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('task_id')->nullable()->index('fk_task_id_idx');
            $table->unsignedBigInteger('tasks_statuses_id')->nullable()->index('fk_tasks_statuses_id_idx');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_statuses_histories');
    }
}
