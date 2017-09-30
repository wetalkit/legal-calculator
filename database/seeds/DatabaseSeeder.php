<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    User::create(
	    	array(
	    	'name' => 'Admin',
		    'email' => 'admin@admin.com',
		    'password' => Hash::make("admin")
            )
        );
        $this->call(ProceduresSeeder::class);
    }
}
