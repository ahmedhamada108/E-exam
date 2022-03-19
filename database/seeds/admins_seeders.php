<?php

use App\Models\admins;
use Illuminate\Database\Seeder;

class admins_seeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        admins::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('adminadmin'),
            'remember_token'=>null
        ]);
    }
}
