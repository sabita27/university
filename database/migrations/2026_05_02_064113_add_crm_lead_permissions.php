<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            ['name' => 'crm-lead-view', 'group' => 'CRM Lead', 'title' => 'View'],
            ['name' => 'crm-lead-create', 'group' => 'CRM Lead', 'title' => 'Create'],
            ['name' => 'crm-lead-edit', 'group' => 'CRM Lead', 'title' => 'Edit'],
            ['name' => 'crm-lead-delete', 'group' => 'CRM Lead', 'title' => 'Delete'],
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::updateOrCreate(
                ['name' => $permission['name']],
                $permission
            );
        }

        $roles = ['Accountant', 'Librarian', 'Receptionist', 'Teacher', 'Office Staff'];
        $roleModels = \Spatie\Permission\Models\Role::whereIn('name', $roles)->get();
        foreach ($roleModels as $role) {
            $role->givePermissionTo(['crm-lead-view', 'crm-lead-create', 'crm-lead-edit']);
        }
    }

    public function down()
    {
        //
    }
};
