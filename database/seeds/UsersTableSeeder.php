<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Generate users by seeders (One super Admin and other clients that we can change their status)
        $users = factory(App\User::class, 3)->create();

            DB::Table('users')->insert(array([
                'name' => 'Jerome',
                'email' => 'jerome@bitchest.fr',
                'password' => Hash::make('jerome'),
                'is_admin' => 1
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@admin.fr',
                'password' => Hash::make('admin'),
                'is_admin' => 0
            ],
            [
                'name' => 'Zakaria',
                'email' => 'zakaria@test.fr',
                'password' => Hash::make('zakaria'),
                'is_admin' => 0
            ]));
    }
}
