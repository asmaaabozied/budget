<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkspaceLinksToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $rolesTable = Config::get('laratrust.tables.roles');
            $permissionsTable = Config::get('laratrust.tables.permissions');
            $allRoles = Role::get();
            $dataRows = ['workspace_links'];
            $crudKeys = ['read_', 'create_', 'update_', 'delete_', 'restore_', 'force_delete_'];

            foreach ($dataRows as $row) {
                foreach ($crudKeys as $crud) {
                    $permission = Permission::create([
                        'name' => $crud.$row,
                        'display_name' => $crud.$row,
                        'description' => $crud.$row,
                        'group' => 'tasks_app',
                    ]);
                    $permissionId = $permission->id;

                    foreach ($allRoles as $role) {
                        // just for admins and managers or any user has permissions that will be added manually by admin
                        if (($role->name == 'Super Admin' || $role->name == 'manger') && in_array($row, $dataRows) && isset($role->id)) { // super admin
                            DB::table('permission_role')->insert([
                                ['permission_id' => $permissionId, 'role_id' => $role['id']],
                            ]);
                        } else {
                        }
                    }
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
        });
    }
}
