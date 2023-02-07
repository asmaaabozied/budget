<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToTasksStatusesHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks_statuses_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable()->index('fk_task_status_history_id_idx');

            $table->foreign('created_by', 'fk_task_status_history_id_idx')
                ->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks_statuses_histories', function (Blueprint $table) {
            $table->dropForeign('fk_task_status_history_id_idx');
        });
    }
}
