<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admins')->delete();
        $adminRecords=[
            [
                'id'=>1,
                'name'=>'admin',
                'type'=>'admin',
                'mobile'=>9876543210,
                'email'=>'admin@gmail.com',
                'password'=>'$2y$10$qbFzSAqtDHrg3O3uv6eWVOZIjACrPVMVo3kqP36O7xNZJj55/zdIa',
                'image'=>'',
                'status'=>1,
            ]

        ];
        
        \DB::table('admins')->insert($adminRecords); //For single record
        // This is use for many data
        // foreach ($adminRecords as $key => $record) {
        //     \App\Models\Admin::create($record);
        // }
    }
}
