<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        if(DB::table('administrators')->count() == 0){
            DB::table('administrators')->insert([
                [
                    'id'               => 1,
                    'firstname'             => 'admin',
                    'lastname'             => 'example',
                    'email'             => 'admin@email.com',
                    'password'          => Hash::make('123123'),
                    'ip'          => request()->ip(),
                    'created_at'          => date("Y-m-d H:i:s"),
                ]
            ]);
        }
    }
}
