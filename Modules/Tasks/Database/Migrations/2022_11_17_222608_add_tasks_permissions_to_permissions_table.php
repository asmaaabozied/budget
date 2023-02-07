<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class AddTasksPermissionsToPermissionsTable extends Migration
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
            $dataRows = ['task', 'tasks_statuse', 'tasks_workspace']; // must be same names in translations and view files to avoid errors when update or add
            $crudKeys = ['read_', 'create_', 'update_', 'delete_', 'restore_', 'force_delete_'];

            foreach ($dataRows as $row) {
                foreach ($crudKeys as $crud) {
                    $permission = Permission::create([
                        'name' => $crud.$row,
                        'display_name' => $crud.$row,
                        'group' => 'tasks_app',
                    ]);
                    $permissionId = $permission->id;

                    foreach ($allRoles as $role) {
                        if ($role->name == 'Super Admin' && in_array($row, $dataRows) && isset($role->id)) { // super admin
                            DB::table('permission_role')->insert([
                                ['permission_id' => $permissionId, 'role_id' => $role['id']],
                            ]);
                        } elseif ($role->name == 'manger' && isset($role->id)) { // managers
                            if ($row !== 'workspaces') {
                                DB::table('permission_role')->insert([
                                    ['permission_id' => $permissionId, 'role_id' => $role->id],
                                ]);
                            }
                        } else { // users
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
