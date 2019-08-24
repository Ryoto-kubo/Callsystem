<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReceptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=10; $i++){
        DB::table('reception')->insert([
            'id' => $i,
            'name' => $i.'さん',
            'peoples' => 2,
            'eat_type' => 1,
            'smoke_type' => 1,
            'tell_number' => '090-7570-4526',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);
        }
    }
}
