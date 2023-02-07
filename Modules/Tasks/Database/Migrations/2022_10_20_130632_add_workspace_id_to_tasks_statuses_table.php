<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkspaceIdToTasksStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks_statuses', function (Blueprint $table) {
            $table->unsignedBigInteger('space_id')->nullable()->index('fk_task_workspace_id_idx');

            $table->foreign('space_id', 'fk_task_workspace_id_idx')
                ->references('id')->on('tasks_workspaces')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks_statuses', function (Blueprint $table) {
            $table->dropForeign('fk_task_workspace_id_idx');
        });
    }
}
