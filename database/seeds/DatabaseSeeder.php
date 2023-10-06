<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        /*DB::table('service_request_types')->insert([
            'name' => 'Request for Requisition',
            'status' => 'A',
        ]);

        DB::table('service_request_types')->insert([
            'name' => 'Request for Warranty',
            'status' => 'A',
        ]);*/

        /*DB::table('service_statuses')->insert([
            'service_status' => 'In Pending Queue',
            'tag' => 'I',
        ]);

        DB::table('service_statuses')->insert([
            'service_status' => 'Assigned',
            'tag' => 'SA',
        ]);

        DB::table('service_statuses')->insert([
            'service_status' => 'Under Process',
            'tag' => 'UP',
        ]);

        DB::table('service_statuses')->insert([
            'service_status' => 'Requested for Warranty',
            'tag' => 'RW',
        ]);

        DB::table('service_statuses')->insert([
            'service_status' => 'Received from Warranty',
            'tag' => 'WR',
        ]);

        DB::table('service_statuses')->insert([
            'service_status' => 'Service Completed',
            'tag' => 'SC',
        ]);

        DB::table('service_statuses')->insert([
            'service_status' => 'Delivered',
            'tag' => 'SD',
        ]);*/
    }
}
