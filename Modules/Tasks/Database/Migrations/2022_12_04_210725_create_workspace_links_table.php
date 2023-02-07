<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkspaceLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspace_links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('link')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedBigInteger('space_id')->nullable()->index('fk_link_workspace_id_idx');
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('space_id', 'fk_link_workspace_id_idx')
                ->references('id')->on('tasks_workspaces')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->foreign('parent_id', 'fk_links_links_fk_id')
                ->references('id')->on('workspace_links')->onUpdate('NO ACTION')->onDelete('NO ACTION');

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
        Schema::dropIfExists('workspace_links');
    }
}
