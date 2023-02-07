<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksWorkspacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_workspaces', function (Blueprint $table) {
            $table->string('name');
            $table->text('description', 65535)->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('branch_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // these relations could not add now because the tables does not created yet ,, we will create them later in another migration file

            //            $table->foreign('company_id')
//                ->references('id')->on('companies');

//            $table->foreign('branch_id')
//                ->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks_workspaces');
    }
}
