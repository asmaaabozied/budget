<?php

use Illuminate\Database\Seeder;

class Permission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = ['users', 'salaries', 'pages', 'linkeds', 'ratings', 'dailytasks', 'categories', 'roles', 'branches', 'countries', 'cities', 'currencies', 'employee', 'LeaveAttendence'];
        $maps = ['create', 'update', 'read', 'delete'];

        foreach ($models as $model) {
            foreach ($maps as $map) {
                \App\Permission::create([

                    'name' => $map.'_'.$model,
                    'display_name' => $map.'_'.$model,
                    'description' => $map.'_'.$model,
                ]);
            }
        }
    }
}
