<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksWorkspacesUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_workspaces_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('space_id')->nullable()->index('fk_task_workspace_id_idx');
            $table->unsignedBigInteger('user_id')->nullable()->index('fk_user_id_idx');
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
        Schema::dropIfExists('tasks_workspaces_users');
    }
}
