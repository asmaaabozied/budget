<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeForeignKeysToTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // these relations we could not add the previously because the tables was not created yet ,, we will add them here

        Schema::table('tasks', function (Blueprint $table) {

            // change columns type
            $table->unsignedBigInteger('company_id')->change();
            $table->unsignedBigInteger('branch_id')->change();
            $table->unsignedBigInteger('space_id')->change();

//            $table->foreign('status_id','fk_tasks_status_id')
//                ->references('id')->on('tasks_statuses')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->foreign('space_id', 'fk_tasks_space_id')
                ->references('id')->on('tasks_workspaces')->onUpdate('NO ACTION')->onDelete('NO ACTION');

//            $table->foreign('company_id','fk_tasks_company_id')
//                ->references('id')->on('companies')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->foreign('branch_id', 'fk_tasks_branch_id')
                ->references('id')->on('branches')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('fk_tasks_space_id');
            // $table->dropForeign('fk_tasks_status_id');
            $table->dropForeign('fk_tasks_company_id');
            $table->dropForeign('fk_tasks_branch_id');
        });
    }
}
