<?php

namespace Database\Seeders;

use Config;
use Exception;

use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Factory;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        DB::beginTransaction();

        try {
            
            User::factory(1)->create([
                'email' => 'root@mail.com',
                'username' => 'root',
                'password' => bcrypt(config('variable.root_pass')),
                'role' => 'root'
            ]);

            User::factory(5)->create([
                'role' => 'admin',
                'password' => bcrypt(config('variable.admin_pass'))
            ]);
    
            User::factory(8)->create([
                'role' => 'staff',
                'password' => bcrypt(config('variable.staff_pass'))
            ]);

            DB::commit();

        } catch(Exception $e) {
            echo $e->getMessage();
            DB::rollback();
        }
    }
}
