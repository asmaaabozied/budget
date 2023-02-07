<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeForeignKeysToTasksStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks_statuses', function (Blueprint $table) {

            // change columns type
            $table->unsignedBigInteger('company_id')->change();

//            $table->foreign('company_id','fk_tasks_statuses_company_id')
//                ->references('id')->on('companies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
            $table->dropForeign('fk_tasks_statuses_company_id');
        });
    }
}
