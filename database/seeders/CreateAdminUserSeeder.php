<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=CreateAdminUserSeeder
        /***********************************************************/
        $admin = User::create([
            'name' => 'root', 
            'email' => 'root@gmail.com',
            'password' => '123456789'
        ]);
        /***********************************************************/
        $secretaire = User::create([
            'name' => 'secretaire', 
            'email' => 'secretaire@gmail.com',
            'password' =>'123456789'
        ]);
        /***********************************************************/
        $caissier = User::create([
            'name' => 'caissier', 
            'email' => 'caissier@gmail.com',
            'password' =>'123456789'
        ]);
        /***********************************************************/
        $roleAdmin      = Role::create(['name' => 'Admin']);
        $roleSecretaire = Role::create(['name' => 'Secretaire']);
        $roleCaissier   = Role::create(['name' => 'Caissier']);
        /***********************************************************/
        $permissions = Permission::pluck('id','id')->all();
        $roleAdmin->syncPermissions($permissions);
        /***********************************************************/
        $admin->assignRole([$roleAdmin->id]);
        $secretaire->assignRole([$roleSecretaire->id]);
        $caissier->assignRole([$roleCaissier->id]);
    }
}
